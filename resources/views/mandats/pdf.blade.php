<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Mandat N° :{{$num_mandat}}</title>

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
    <!-- CSS only -->
    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    --}}
</head>

<body>
    <div class="invoice-box pt-5">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr class="text-center">

                            <td class="title" style="text-align: center">
                                <img src="assets/img/LogoImp.png" style=" max-width: 300px" />
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
            <tr>
                <td colspan="3" style="text-align: left;width:40%">
                    Réf #: <strong>{{$num_mandat}}</strong><br />

                    Date d'impression: <strong>{{Carbon\carbon::now()->format('d/m/Y')}}</strong>
                </td>
                <td colspan="3" style="text-align: right;width:40%">
                    Alger, le <strong>{{Carbon\carbon::parse($date_mandat)->format('d/m/Y')}}</strong>
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
                <td colspan="6" style="text-align: center">
                    <h2>ACCEPTATION DE MANDAT</h2>
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
                <td colspan="6">


                </td>
            </tr>

        </table>
        <div style="color:black">
            Je soussigné, Hakima Meddahi, Commissaire aux comptes demeurant à Coopérative el Salama Bt53 N° D2
            Birkhadem, Alger, inscrit au Tableau de l'Ordre des Commissaires Aux Comptes sous le n°193, déclare
            l'acceptation
            du Mandat de {{$prestation}}/ Commissariat aux Comptes, au profit de {{$raison_social}} dont le siège social
            est sis à
            {{$adresse}} au titre des exercices du {{Carbon\carbon::parse($start)->format('Y')}} au
            {{Carbon\carbon::parse($end)->format('Y')}}<br><br>
            Le commissaire aux comptes déclare n'être frappé d'aucune incompatibilité par la législation et la
            réglementation en vigueur.

        </div>
        <br><br><br><br><br><br><br><br>
    </div>



    <table style="width: 100%" cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="4"></td>
            <td colspan="2" style="text-align: right;width:40%">
                <table>
                    <tr>
                        <td style="text-align: center">
                            <p style="text-align: center">
                                <span style="text-decoration: underline">M. H MEDDAHI</span>
                                <br>
                                Commissaire Aux Comptes
                            </p>
                        </td>
                    </tr>
                </table>


            </td>
        </tr>
    </table>






</body>

</html>
