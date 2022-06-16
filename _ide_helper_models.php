<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Categorie
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $designation
 * @property string $indice_tarif
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereIndiceTarif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categorie whereUpdatedAt($value)
 */
	class Categorie extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Commentaire
 *
 * @property int $id
 * @property string $description
 * @property string $date_commentaire
 * @property int $user_id
 * @property int $tache_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tache $tache
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire query()
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereDateCommentaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereTacheId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commentaire whereUserId($value)
 */
	class Commentaire extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Convention
 *
 * @property int $id
 * @property int|null $mission_id
 * @property string $date_convention
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $num_convention
 * @method static \Illuminate\Database\Eloquent\Builder|Convention newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Convention newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Convention query()
 * @method static \Illuminate\Database\Eloquent\Builder|Convention whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Convention whereDateConvention($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Convention whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Convention whereMissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Convention whereNumConvention($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Convention whereUpdatedAt($value)
 */
	class Convention extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Devis
 *
 * @property int $id
 * @property string $num_devis
 * @property string $date_devis
 * @property int $exercice_id
 * @property int $entreprise_id
 * @property int $prestation_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $total
 * @property-read \App\Models\Entreprise $entreprise
 * @property-read \App\Models\Exercice $exercice
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Mission[] $missions
 * @property-read int|null $missions_count
 * @property-read \App\Models\Prestation $prestation
 * @method static \Illuminate\Database\Eloquent\Builder|Devis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Devis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Devis query()
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereDateDevis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereEntrepriseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereExerciceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereNumDevis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis wherePrestationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Devis whereUpdatedAt($value)
 */
	class Devis extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Entreprise
 *
 * @property int $id
 * @property string $raison_social
 * @property string $num_registre_commerce
 * @property string $num_art_imposition
 * @property string $num_id_fiscale
 * @property string $adresse
 * @property string $num_tel
 * @property string $email
 * @property int $fiscal_id
 * @property int $activite_id
 * @property int $categorie_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RegimeFiscal $RegimeFiscal
 * @property-read \App\Models\TypeActivite $activiteType
 * @property-read \App\Models\Categorie $categorie
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Devis[] $devis
 * @property-read int|null $devis_count
 * @method static \Database\Factories\EntrepriseFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise query()
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereActiviteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereCategorieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereFiscalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereNumArtImposition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereNumIdFiscale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereNumRegistreCommerce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereNumTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereRaisonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entreprise whereUpdatedAt($value)
 */
	class Entreprise extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Exercice
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereUpdatedAt($value)
 */
	class Exercice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Facture
 *
 * @property int $id
 * @property string $num_fact
 * @property string $date_facturation
 * @property string $montant
 * @property int|null $mission_id
 * @property int|null $exercice_id
 * @property int|null $type_facture_id
 * @property int|null $fact_avoir_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Exercice|null $exercice
 * @property-read Facture|null $factureAvoir
 * @property-read \App\Models\Mission|null $mission
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Paiement[] $paiements
 * @property-read int|null $paiements_count
 * @property-read \App\Models\TypeFacture|null $typefacture
 * @method static \Illuminate\Database\Eloquent\Builder|Facture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facture query()
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereDateFacturation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereExerciceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereFactAvoirId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereMissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereNumFact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereTypeFactureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facture whereUpdatedAt($value)
 */
	class Facture extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mandat
 *
 * @property int $id
 * @property int|null $mission_id
 * @property string $date_mandat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $num_mandat
 * @method static \Illuminate\Database\Eloquent\Builder|Mandat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mandat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mandat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mandat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandat whereDateMandat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandat whereMissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandat whereNumMandat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mandat whereUpdatedAt($value)
 */
	class Mandat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mission
 *
 * @property int $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property int $allDay
 * @property string $color
 * @property string $textColor
 * @property int|null $devis_id
 * @property int|null $prestation_id
 * @property int $entreprise_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $status
 * @property string $num_missions
 * @property string $total
 * @property-read \App\Models\Convention|null $convention
 * @property-read \App\Models\Entreprise $entreprise
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Facture[] $factures
 * @property-read int|null $factures_count
 * @property-read mixed $ende
 * @property-read mixed $raison_social
 * @property-read mixed $starte
 * @property-read mixed $status_int
 * @property-read mixed $statustxt
 * @property-read \App\Models\Mandat|null $mandat
 * @property-read \App\Models\Prestation|null $prestation
 * @method static \Illuminate\Database\Eloquent\Builder|Mission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereAllDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereDevisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereEntrepriseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereNumMissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission wherePrestationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mission whereUpdatedAt($value)
 */
	class Mission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Paiement
 *
 * @property int $id
 * @property string $montant
 * @property string $num_piece_c
 * @property string $date_paiement
 * @property int|null $type_paiement_id
 * @property int|null $facture_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Facture|null $facture
 * @property-read \App\Models\TypePaiement|null $typepaiement
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereDatePaiement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereFactureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereNumPieceC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereTypePaiementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Paiement whereUpdatedAt($value)
 */
	class Paiement extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Prestation
 *
 * @property int $id
 * @property string $designation
 * @property string $tarif_initial
 * @property int $durée
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $code_prestation
 * @method static \Illuminate\Database\Eloquent\Builder|Prestation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prestation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prestation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prestation whereCodePrestation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prestation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prestation whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prestation whereDurée($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prestation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prestation whereTarifInitial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prestation whereUpdatedAt($value)
 */
	class Prestation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RegimeFiscal
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $designation
 * @property string $indice_tarif
 * @method static \Illuminate\Database\Eloquent\Builder|RegimeFiscal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegimeFiscal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegimeFiscal query()
 * @method static \Illuminate\Database\Eloquent\Builder|RegimeFiscal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegimeFiscal whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegimeFiscal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegimeFiscal whereIndiceTarif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegimeFiscal whereUpdatedAt($value)
 */
	class RegimeFiscal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $rolename
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tache
 *
 * @property int $id
 * @property string $designation
 * @property string $title
 * @property string $start
 * @property string $end
 * @property int $allDay
 * @property string $color
 * @property string $textColor
 * @property int $status
 * @property int $mission_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $num_tache
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Commentaire[] $commentaires
 * @property-read int|null $commentaires_count
 * @property-read mixed $ende
 * @property-read mixed $starte
 * @property-read mixed $status_int
 * @property-read mixed $statustxt
 * @property-read \App\Models\Mission $mission
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Tache newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tache newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tache query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereAllDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereMissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereNumTache($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tache whereUserId($value)
 */
	class Tache extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TypeActivite
 *
 * @property int $id
 * @property string $designation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TypeActivite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeActivite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeActivite query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeActivite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeActivite whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeActivite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeActivite whereUpdatedAt($value)
 */
	class TypeActivite extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TypeFacture
 *
 * @property int $id
 * @property string $code
 * @property string $designation
 * @method static \Illuminate\Database\Eloquent\Builder|TypeFacture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeFacture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeFacture query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeFacture whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeFacture whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeFacture whereId($value)
 */
	class TypeFacture extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TypePaiement
 *
 * @property int $id
 * @property string $designation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TypePaiement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypePaiement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypePaiement query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypePaiement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypePaiement whereDesignation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypePaiement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypePaiement whereUpdatedAt($value)
 */
	class TypePaiement extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $prenom
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $role_id
 * @property-read mixed $fullname
 * @property-read mixed $role_f
 * @property-read mixed $role_option
 * @property-read mixed $role_title
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role|null $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

