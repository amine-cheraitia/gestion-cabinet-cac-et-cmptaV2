<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Convention N° :{{$num_convention}}</title>

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
    {{-- <div class="invoice-box pt-5">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr class="text-center">

                            <td class="title" style="text-align: center">
                                <img src="https://www.sparksuite.com/images/logo.png"
                                    style="width: 100%; max-width: 300px" />
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
                    Réf #: <strong>{{$num_convention}}</strong><br />

                    Date d'impression: <strong>{{Carbon\carbon::now()->format('d/m/Y')}}</strong>
                </td>
                <td colspan="3" style="text-align: right;width:40%">
                    Alger, le <strong>{{Carbon\carbon::parse($date_convention)->format('d/m/Y')}}</strong>
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
            Le commissaire aux comptes déclare n'ête frappé d'aucune incompatibilité par la législation et la
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
    </table>--}}


    <header class="invoice-box " style="font-weight: bold; text-decoration: underline; text-align: center;color: black">
        République Algérienne Démocratique et Populaire <br>
        Conseil National de l’Organisation Nationale des Comptables Agréés <br>
        Chambre Nationale des Commissaires aux Comptes <br>

    </header>
    <br><br><br>
    <div id="first" style="text-align: center;position: relative; height: 100vh;">
        <div style="margin-bottom: 50px">
            {{-- <img src="https://www.sparksuite.com/images/logo.png"
                style="width: 100%; max-width: 300px;font-weight: bold" /> --}}
            <img src="assets/img/LogoImp.png" style=" max-width: 300px" />
            <br><br>
            <h4>CABINET MEDDAHI</h4>
            <h5> Comptabilité et commissariat aux comptes <br><br>
                Adresse : 554 Cité el djawhara, BT11 N°01 Les Halles, Alger.</h5>
        </div>
        <div style="text-align: left;font-weight: bold">
            N°: {{$num_convention}} <br>
            Date : {{Carbon\Carbon::parse($date_convention)->format('d/m/Y')}}
        </div>
        <br><br>
        <div>
            <h3>CONVENTION DE PRESTATION DE SERVICES<br>
                "{{strtoupper($prestation)}}"
            </h3>
        </div>
        <br><br>
        <br><br>
        <br><br>
        <br><br>
        <br>
        <div style="text-align: center;font-weight: bold; position absolute">Textes de Référence : <br>
            *Article 45 de la loi 10-01 du 11/07/2010 <br>
            * Décret exécutif n° 04/02 du 23/06/2004
        </div>
        <br><br><br>
        <footer style="text-align:left">{{-- {PAGENO} --}}</footer>
    </div>
    <div id="second" style="font-size: 12px ">
        <br>
        <br>
        <br>
        En date du {{Carbon\carbon::parse($date_convention)->format('d/m/Y')}} , Il a été convenu ce qui suit entre :
        <br><br>
        <strong>Madame Karima Meddahi Commissaire aux comptes du Cabinet Meddahi.</strong>
        <br>
        Adresse professionnelle : 554 Cité el djawhara, BT11 N°01 Les Halles, Alger.
        <br>
        Agrément n° : 1366 Du 01/02/2013

        <br>
        Ci-après dénommé « Le Cabinet » / Meddahi
        <br>
        <br>
        D'autre part,
        <br>
        <br>
        Raison social : <strong>{{strtoupper($raison_social)}}</strong>
        <br>
        Adresse du siége social: {{$adresse}}
        <br>
        <br>
        <ul>
            <li>NIF : {{$nif}}</li>
            <li>ART :{{$art}}</li>
            <li>RC :{{$rc}}</li>
        </ul>
        <br>
        D‘autre part,
        <br><br>
        Les Deux Parties, ayant déclaré disposer de leur capacité à conclure le présent contrat
        <br>
        Il ont convenu ce qui suit :
        <br><br>
        <h4>Article 01 : Objet du contrat :</h4>

        - Aux termes du présent alinéa, les deux parties s’engagent, séparément, à : <br>

        <strong>• Pour le cabinet :</strong> En vertu des articles 41et 42 de la loi 10-01 du 11/07/2020
        <h5>01- Services de gestion, suivi et consulting</h5>
        - Elaboration des fiches de paie et journal de paie <br>
        - Elaboration et présentation des bilans comptables annuels <br>
        - Répondre aux correspondances fiscales et parafiscales, et leur suivi <br>
        - Elaboration des déclarations fiscales <br>
        - Elaboration et présentation des déclarations parafiscales, mensuelles et annuelles ( CASNOS) <br>
        - Se faire extraire l’attestation de paiement des montants dus et l’attestation de non imposition <br>

        <h5>02- Services fiscaux : </h5>
        - Actualisation et mise à à jour des livrets comptables et commerciaux ( selon articles 09, 10 et 11) de code de
        commerce – Chapitre Livrets commerciaux ), ( selon article 42 de la loi 10-01) <br>
        - Tenue, élaboration et présentation du bilan fiscal annuel ( selon dispositions des articles 99-1 et 151-1 du
        code des impôts directs et taxes diverses, section déclarations des contribuables et section obligations des
        sociétés) <br>
        <h5>03- Assistance et représentation :</h5>
        - Devant l’administration des impôts, de sécurité sociale, caisse de chômage, CASNOS, <br>
        - Devant l’inspection du travail<br>
        - Devant le registre de commerce et la direction de commerce<br>
        - Devant le trésor public<br>
        - Devant les banques et établissement d’investissement<br><br>
        Selon les dispositions de l’article 43 de la loi 10-01 du 11/07/2010.<br>
        <strong>• Pour le client : </strong> <br><br>
        - Le Client ( Personne physique ou morale ) sera soumis au plan de charges, selon le règlement intérieur du
        Cabinet ( Comptable) <br>
        - Le Client devra mettre à la disposition du Cabinet toutes les renseignements et documents comptables et
        financiers considérés nécessaires pour le la bonne exécution de la mission de prestation ; et s’oblige à
        respecter les délais fixés avant expiration des durées finales légales requises pour éviter tout retard. <br>
        - Le Client déclare assumer toute responsabilité en matière des informations fournies au Cabinet, et que le
        Cabinet décline toute responsabilité en ce qui concerne les bulletins financiers, registres, factures,
        déclarations fiscales et parafiscales ou comptables ou tous autres rapports financiers, selon dispositions de
        l’article 42 de la loi 10-01. <br>
        - Il s’engage également à fournir tous les états, renseignements, éclaircissements et réponses sur les
        observations ; de fournir les originaux de ces documents, à la demande et au vœu du Cabinet, et qui s’avèrent
        nécessaires pour la bonne exécution de la mission du Cabinet, convenue dans le présent contrat. Le Client sera
        seul responsable du contenu de ces documents. <br>
        <br>
        <h4>Article02 : Le secret professionnel </h4>
        <h5>Alinéa 01 :</h5>
        - La Première Partie et ses collaborateurs s’obligent à garder le secret professionnel, étant donné que tous les
        états et renseignements du Client sont de nature sensible et confidentielle. De ce fait, le cabinet n’est pas
        autorisé à diffuser ces renseignements, sans l’accord préalable écrit du Client, sauf autrement stipulé, selon
        l’article 71 de la loi 10-01 relatif à la profession de l’expert comptable, commissaire aux comptes et comptable
        agréé. <br>
        <h5>Alinéa 02 :</h5>
        - Le Cabinet est tenu d’aviser le Client, en cas de constations d’une difficulté ou obstacle empêchant la bonne
        exécution de la mission. <br>

        <h4>Article 03 : Honoraires :</h4>
        - En vertu des dispositions de l’article 45 de la loi 10-01 et sur accord des Parties, le Client s’engage à
        s’acquitter des honoraires dus au Cabinet <br>
        Le montant total de la prestation est de <strong>{{ number_format($montant, 2, ',', ' ')}}</strong> Dinars
        algérien, le payementsse ferait en trois tranche <br>
        La premiére tranche est a <strong>30%</strong> du montant total de la prestation. <br>
        La seconde tranche est a <strong>30%</strong> du montant de la prestation.
        <br>La Derniére est a <strong>40%</strong> du montant de la prestation <br>
        <ul>
            <li>A chaque paiement le cabinet s'engage a délivré une facture</li>
            <li>La premiére partie s'engage a livret des travaux intermediaire au paiement de la seconde tranche et la
                totalité des travaux après le dernniére paiement qui est prévu a la fin de la prestation</li>
            <li>En cas de rupture du contrat du contrat du fait de la deuxième Partie, sans raison légale ou
                professionnelle, le Cabinet sera en droit de percevoir le reste du montant convenu stipulé dans le
                présent contrat, et toutes les échéances dues avant leurs dates, seront payées, même si les travaux ne
                sont pas fournis, totalement ou partiellement</li>
            <li>Les honoraires des prestations seront réglés par le Client selon une note d’honoraires, dans un délai ne
                dépassant un mois (30 jours), à compter de la date de remise de ladite note d’honoraires ; soit en
                espèces, par un chèque ou par virement bancaire

            </li>
            <li>
                Le Client s’engage d’honorer toutes ses obligations financières pour le régler les honoraires du Cabinet
                dans les délais contractuels finaux fixés par le cabinet.
            </li>
        </ul>

        <h4>Article 04 : Force majeure </h4>
        - Il est entendu par ‘Force majeure’ tout acte ou événement imprévisible ou incontournable pouvant avoir des
        impacts directs ou indirects sur l’exécution normale des obligations nées par la présente convention. <br>
        - De ce fait, la partie atteinte par cette force majeure et empêchée d’honorer, totalement ou partiellement, ses
        obligations contractuelles, ne sera considérée responsable de cette défaillance. Elle sera exonérée de cette
        responsabilité pour raison de suspension provisoire du contrat, jusqu’à disparition des raisons ayant entrainé
        cette rupture des prestations. <br>

        <h4>Article 05 : Modification :</h4>
        - Toute modification sur les dispositions du présent contrat sera l’objet d’un avenant approuvé et signé par les
        deux parties.
        <h4>Article 06 : Responsabilité</h4>
        - Le Client accepte et consent d’indemniser et de protéger le Cabiner contre tout préjudice causé par toute
        erreur, et de toute réclamation du fait de perte ou préjudice subi, à l’exception des cas de mauvais
        comportement ou négligence de la part du Cabinet.
        <h4>Article 07 : Rupture du contrat</h4>
        - Il est autorisé aux parties de mettre fin au contrat de prestation de services comptables, sous condition de
        présenter à l’autre partie un préavis de (30 jours). <br>
        - En cas de résiliation dudit contrat, des notes d’honoraires portant sur les services faits, seront soumises
        selon les modalités de paiement citées dans le présent contrat.
        <h4>Article 08 : Litiges</h4>
        - Tout litige né à l’occasion d’interprétation ou d’exécution du présent contrat sera réglé à l’amiable. <br>
        - A défaut, ledit litige sera exposé devant le tribunal du lieu du Cabinet, notamment les litiges liés à
        l’exécution ou l’annulation dudit contrat. <br>
        <h4>Article 09 : Durée du contrat</h4>
        - Le présent contrat entrera en vigueur à compter de la date sa signature par les deux parties. Il est valable
        pour une durée de trois (03 ans). Il sera reconduit d’office, en l’absence d’un préavis de trente (30) jours
        avant son expiration, de l’une des parties, exprimant son intention de le rompre. <br><br><br>
        <p style="text-align: right">Fait à Alger, le {{Carbon\Carbon::parse($date_convention)->format('d/m/Y')}}</p>
        <br>
        <br>
        <br>
        <br>
        <table style="width: 100%">
            <tr>
                <td colspan="6" style="text-align: center">Le Cabinet</td>
                <td colspan="6" style="text-align: center">Le Client</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center; font-size: 14px">Signature du représentant légal</td>
                <td colspan="6" style="text-align: center; font-size: 14px">Signature du représentant légal</td>
            </tr>
        </table>





    </div>


    <footer style="position: fixed; bottom: 5px">{{-- {PAGENO} --}}</footer>
</body>

</html>
