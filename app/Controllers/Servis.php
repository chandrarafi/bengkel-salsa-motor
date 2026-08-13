<?php

namespace App\Controllers;

use App\Models\ServisModel;

class Servis extends BaseController
{
    protected $servisModel;

    public function __construct()
    {
        $this->servisModel = new ServisModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Kelola Master Jasa Servis',
            'servis' => $this->servisModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('page/content/form/servis/index', $data);
    }

    public function create()
    {
        return redirect()->to('/admin/servis');
    }

    public function store()
    {
        $jenisServis = trim($this->request->getPost('jenis_servis') ?? $this->request->getPost('Jenis_servis') ?? '');
        $biaya       = (float)($this->request->getPost('biaya') ?? $this->request->getPost('Biaya') ?? 0);
        $keterangan  = trim($this->request->getPost('keterangan') ?? $this->request->getPost('Keterangan') ?? '');

        $rules = [
            'kodeservis'     => 'required|min_length[3]|max_length[10]|is_unique[servis.kodeservis]',
            'jenis_servis'   => 'required|min_length[3]|max_length[50]',
            'biaya'          => 'required|numeric|greater_than_equal_to[0]',
            'estimasi_waktu' => 'permit_empty|integer|greater_than_equal_to[0]',
            'keterangan'     => 'permit_empty',
        ];

        $messages = [
            'kodeservis' => [
                'required'   => 'Kode servis wajib diisi.',
                'min_length' => 'Kode servis minimal 3 karakter.',
                'max_length' => 'Kode servis maksimal 10 karakter.',
                'is_unique'  => 'Kode servis sudah digunakan.',
            ],
            'jenis_servis' => [
                'required'   => 'Jenis / nama jasa servis wajib diisi.',
                'min_length' => 'Jenis / nama jasa servis minimal 3 karakter.',
                'max_length' => 'Jenis / nama jasa servis maksimal 50 karakter.',
            ],
            'biaya' => [
                'required'              => 'Biaya jasa servis wajib diisi.',
                'numeric'               => 'Biaya harus berupa angka.',
                'greater_than_equal_to' => 'Biaya tidak boleh bernilai negatif.',
            ],
            'estimasi_waktu' => [
                'integer'               => 'Estimasi waktu harus berupa angka menit.',
                'greater_than_equal_to' => 'Estimasi waktu tidak boleh negatif.',
            ],
        ];

        // Prepare data for validation check
        $dataPost = $this->request->getPost();
        $dataPost['jenis_servis'] = $jenisServis;
        $dataPost['biaya']        = $biaya;
        $dataPost['keterangan']   = $keterangan;

        if (!$this->validateData($dataPost, $rules, $messages)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validasi gagal. Silakan periksa kembali inputan Anda.',
                    'errors'  => $this->validator->getErrors(),
                ]);
            }
            return redirect()->to('/admin/servis')->withInput()->with('errors', $this->validator->getErrors())->with('modal', 'add');
        }

        $data = [
            'kodeservis'     => strtoupper(trim($this->request->getPost('kodeservis'))),
            'jenis_servis'   => $jenisServis,
            'Jenis_servis'   => $jenisServis,
            'biaya'          => $biaya,
            'Biaya'          => $biaya,
            'keterangan'     => $keterangan,
            'Keterangan'     => $keterangan,
            'estimasi_waktu' => (int)($this->request->getPost('estimasi_waktu') ?: 30),
        ];

        $this->servisModel->insert($data);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Jasa servis baru berhasil ditambahkan.',
            ]);
        }

        session()->setFlashdata('success', 'Jasa servis baru berhasil ditambahkan.');
        return redirect()->to('/admin/servis');
    }

    public function edit($id = null)
    {
        return redirect()->to('/admin/servis');
    }

    public function update($kodeservis = null)
    {
        $servis = $this->servisModel->find($kodeservis);

        if (!$servis) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Data jasa servis tidak ditemukan.',
                ]);
            }
            session()->setFlashdata('error', 'Data jasa servis tidak ditemukan.');
            return redirect()->to('/admin/servis');
        }

        $jenisServis = trim($this->request->getPost('jenis_servis') ?? $this->request->getPost('Jenis_servis') ?? '');
        $biaya       = (float)($this->request->getPost('biaya') ?? $this->request->getPost('Biaya') ?? 0);
        $keterangan  = trim($this->request->getPost('keterangan') ?? $this->request->getPost('Keterangan') ?? '');

        $rules = [
            'jenis_servis'   => 'required|min_length[3]|max_length[50]',
            'biaya'          => 'required|numeric|greater_than_equal_to[0]',
            'estimasi_waktu' => 'permit_empty|integer|greater_than_equal_to[0]',
            'keterangan'     => 'permit_empty',
        ];

        $messages = [
            'jenis_servis' => [
                'required'   => 'Jenis / nama jasa servis wajib diisi.',
                'min_length' => 'Jenis / nama jasa servis minimal 3 karakter.',
                'max_length' => 'Jenis / nama jasa servis maksimal 50 karakter.',
            ],
            'biaya' => [
                'required'              => 'Biaya jasa servis wajib diisi.',
                'numeric'               => 'Biaya harus berupa angka.',
                'greater_than_equal_to' => 'Biaya tidak boleh bernilai negatif.',
            ],
            'estimasi_waktu' => [
                'integer'               => 'Estimasi waktu harus berupa angka menit.',
                'greater_than_equal_to' => 'Estimasi waktu tidak boleh negatif.',
            ],
        ];

        $dataPost = $this->request->getPost();
        $dataPost['jenis_servis'] = $jenisServis;
        $dataPost['biaya']        = $biaya;
        $dataPost['keterangan']   = $keterangan;

        if (!$this->validateData($dataPost, $rules, $messages)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validasi gagal. Silakan periksa kembali inputan Anda.',
                    'errors'  => $this->validator->getErrors(),
                ]);
            }
            return redirect()->to('/admin/servis')->withInput()->with('errors', $this->validator->getErrors())->with('modal', 'edit')->with('edit_kodeservis', $kodeservis);
        }

        $updateData = [
            'jenis_servis'   => $jenisServis,
            'Jenis_servis'   => $jenisServis,
            'biaya'          => $biaya,
            'Biaya'          => $biaya,
            'keterangan'     => $keterangan,
            'Keterangan'     => $keterangan,
            'estimasi_waktu' => (int)($this->request->getPost('estimasi_waktu') ?: 30),
        ];

        $this->servisModel->update($kodeservis, $updateData);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Data jasa servis berhasil diperbarui.',
            ]);
        }

        session()->setFlashdata('success', 'Data jasa servis berhasil diperbarui.');
        return redirect()->to('/admin/servis');
    }

    public function delete($kodeservis = null)
    {
        $servis = $this->servisModel->find($kodeservis);

        if (!$servis) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Data jasa servis tidak ditemukan.',
                ]);
            }
            session()->setFlashdata('error', 'Data jasa servis tidak ditemukan.');
            return redirect()->to('/admin/servis');
        }

        $this->servisModel->delete($kodeservis);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Data jasa servis berhasil dihapus.',
            ]);
        }

        session()->setFlashdata('success', 'Data jasa servis berhasil dihapus.');
        return redirect()->to('/admin/servis');
    }
}
