<div style="color: #333; height: 100%; width: 100%;" height="100%" width="100%">
    <table cellspacing="0" style="border-collapse: collapse; padding: 40px; width: 100%;" width="100%">
        <tbody>
            <tr>
                <td width="5px" style="padding: 0;"></td>
                <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                    <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="padding: 0;">
                                    <a href="#" style="color: #348eda;">
                                        <img src="<?= base_url() ?>assets/images/logo.png" alt="Bootdey.com" style="height: 50px; max-width: 100%; width: 157px;" height="50" width="157" />
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="5px" style="padding: 0;"></td>
            </tr>

            <tr>
                <td width="5px" style="padding: 0;"></td>
                <td bgcolor="#FFFFFF" style="border: 1px solid #000; clear: both; display: block; margin: 0 auto; max-width: 200px; padding: 0;">
                    <table width="100%" style="border-bottom: 1px solid #eee; border-collapse: collapse; color: #999;">
                        <tbody>
                            <tr>
                                <td width="50%" style="padding: 20px; color: #333;">Nomor Antrian <br><br><strong style="color: #333; font-size: 24px;"><?= $antrianTotal ?></strong></td>
                                <td width="50%" style="padding: 20px; color: #333;">Sisa Antrian <br><br><strong style="color: #333; font-size: 24px;"><?= $antrianTotal - $antrianSaatIni ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="padding: 0;"></td>
                <td width="5px" style="padding: 0;"></td>
            </tr>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    window.print();
</script>