<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Devis N° :{{$num_devis}}</title>

    <style>
        @page {
            header: page-header;
            footer: page-footer;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            /*             border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{-- https://www.sparksuite.com/images/logo.png --}}assets/img/LogoImp.png"
                                    style=" max-width: 300px" />
                            </td>

                            <td style="text-align: left;width:40%">
                                N° Devis #: <strong>{{$num_devis}}</strong><br />
                                Date du Devis:
                                <strong>{{Carbon\carbon::parse($date_devis)->format('d-m-Y')}}</strong><br />
                                Date d'impression: <strong>{{Carbon\carbon::now()->format('d-m-Y')}}</strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>

            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td colspan="3" style="width:60%">
                                <strong>CABINET MEDDAHI</strong><br />
                                <strong>Comptabilité et commissariat aux comptes</strong><br />
                                554 Cité el djawhara, BT11 N°01 Les Halles, Alger.<br>


                            </td>

                            <td colspan="3" style="text-align: left;width:40%">
                                <strong>{{$raison_social}}</strong><br />
                                adresse :{{$adresse}}<br />
                                N°RC :{{$num_registre_commerce}}<br />
                                ART IMP :{{$num_art_imposition}}<br />
                                NIF :{{$num_id_fiscale}}<br />
                                Email :{{$email}}<br />

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            {{-- <tr class="heading">
                <td>Payment Method</td>

                <td>Check #</td>
            </tr>

            <tr class="details">
                <td>Check</td>

                <td>1000</td>
            </tr> --}}

            <tr class="heading">
                <td colspan="4">Designation</td>

                <td style="text-align: right" colspan="2">Montant</td>
            </tr>

            <tr class="item">
                <td colspan="4">{{$prestation}}</td>

                <td style="text-align: right" colspan="2">{{ number_format($total, 2, ',', ' ');}} DZD</td>
            </tr>

            {{-- <tr class="item">
                <td>Hosting (3 months)</td>

                <td>$75.00</td>
            </tr>

            <tr class="item last">
                <td>Domain name (1 year)</td>

                <td>$10.00</td>
            </tr> --}}
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>

            <tr {{-- class="total" --}}>
                <td style="text-align: right;font-weight: bold;" colspan="4">
                    Total:
                </td>

                <td colspan="2" style="font-weight: bold;text-align: right">{{ number_format($total, 2, ',', ' ')}}
                    DZD
                </td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td colspan="6">Arrêté le présent devis à la somme de {{$montant_lettre}} Dinars
                    Algérien.</td>
            </tr>
        </table>

    </div>
</body>

</html>
