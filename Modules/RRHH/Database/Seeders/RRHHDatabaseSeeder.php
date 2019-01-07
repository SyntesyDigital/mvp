<?php

namespace Modules\RRHH\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\RRHH\Entities\Offers\Candidate;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Modules\RRHH\Entities\Offers\Offer;
use Modules\RRHH\Entities\Tools\EmailTemplate;
use Modules\RRHH\Entities\Tools\SiteList;

class RRHHDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       $admin = User::create([
           'email' => 'admin@bar.com',
           'password' => bcrypt('secret'),
           'firstname' => 'John',
           'lastname' => 'Admin',
       ]);

       $recruiter = User::create([
           'email' => 'recruiter@bar.com',
           'password' => bcrypt('secret'),
           'firstname' => 'John',
           'lastname' => 'Recruiter',
       ]);

       $candidate = User::create([
           'email' => 'candidate@bar.com',
           'password' => bcrypt('secret'),
           'firstname' => 'John',
           'lastname' => 'Candidate',
       ]);




       $candidateInfo = Candidate::create([
           'user_id' => $candidate->id,
           'civility' => Candidate::CIVILITY_MALE,
           'type' => Candidate::TYPE_NORMAL,
       ]);

       ////////////////////////
       //		Roles
       ////////////////////////

       //admin
       $adminRole = new Role();
       $adminRole->name = 'admin';
       $adminRole->display_name = 'Admin'; // optional
       $adminRole->description = 'Superuser of the app'; // optional
       $adminRole->save();

       //recruiter
       $recruiterRole = new Role();
       $recruiterRole->name = 'recruiter';
       $recruiterRole->display_name = 'Recruteur'; // optional
       $recruiterRole->description = 'Recruiter'; // optional
       $recruiterRole->save();

       //candidate
       $candidateRole = new Role();
       $candidateRole->name = 'candidate';
       $candidateRole->display_name = 'Candidate'; // optional
       $candidateRole->description = 'Candidate'; // optional
       $candidateRole->save();

       //candidate
       $customerRole = new Role();
       $customerRole->name = 'customer';
       $customerRole->display_name = 'Customer'; // optional
       $customerRole->description = 'Customer'; // optional
       $customerRole->save();

       // role attach alias
       $admin->attachRole($adminRole);
       $recruiter->attachRole($recruiterRole);
       $candidate->attachRole($candidateRole);

       //Candidate part
       $candidate_part = new Candidate([
           'civility' => Candidate::CIVILITY_MALE,
           'resume_file' => '',
           'recommendation_letter' => '',
           'type' => Candidate::TYPE_NORMAL,
           'registration_number' => '',
           'registered_at' => date('Y-m-d'),
       ]);
       $candidate_part->user()->associate($candidate);
       $candidate_part->Save();

         // ------------------------------------------------------ //
         //  SITE LISTE
         // ------------------------------------------------------ //
         SiteList::create([
             'identifier' => 'jobs1',
             'name' => 'Métier 1',
             'type' => 'select',
             'value' => json_encode([
                 [
                     'name' => 'Métier 1',
                     'value' => 'METIER_1',
                 ],
                 [
                     'name' => 'Métier 2',
                     'value' => 'METIER_2',
                 ],
             ]),
         ]);

         SiteList::create([
             'identifier' => 'jobs2',
             'name' => 'Métier 2',
             'type' => 'select',
             'value' => json_encode([
                 [
                     'name' => 'Métier 1',
                     'value' => 'METIER_1',
                 ],
                 [
                     'name' => 'Métier 2',
                     'value' => 'METIER_2',
                 ],
             ]),
         ]);

         SiteList::create([
             'identifier' => 'offer_status',
             'name' => 'Status offre d\'emploi',
             'type' => 'select',
             'value' => json_encode([
                 [
                     'name' => 'Active',
                     'value' => Offer::STATUS_ACTIVE,
                 ],
                 [
                     'name' => 'Inactive',
                     'value' => Offer::STATUS_UNACTIVE,
                 ],
             ]),
         ]);

         SiteList::create([
             'identifier' => 'contracts',
             'name' => 'Type de contrat',
             'type' => 'select',
             'value' => json_encode([
                 [
                     'name' => 'CDD',
                     'value' => 'TYPE_CDD',
                 ],
                 [
                     'name' => 'CDI',
                     'value' => 'TYPE_CDI',
                 ],
                 [
                     'name' => 'CDT',
                     'value' => 'TYPE_CDT',
                 ],
             ]),
         ]);

         SiteList::create([
             'identifier' => 'salaries',
             'name' => 'Fourchettes de salaire',
             'type' => 'select',
             'value' => json_encode([
                 [
                     'name' => '< 20 000€',
                     'value' => '<20000',
                 ],
                 [
                     'name' => 'de 20 000€ 30 000€',
                     'value' => '20000|30000',
                 ],
                 [
                     'name' => 'de 30 000€ 40 000€',
                     'value' => '30000|40000',
                 ],
                 [
                     'name' => 'de 40 000€ 50 000€',
                     'value' => '40000|50000',
                 ],
                 [
                     'name' => '> 50 000€',
                     'value' => '>50000',
                 ],
             ]),
         ]);

         SiteList::create([
             'identifier' => 'schedule',
             'name' => 'Horaires',
             'type' => 'checkbox',
             'value' => json_encode([
                 [
                     'name' => 'Horaires normaux',
                     'value' => 'SCHEDULE_NORMAL',
                 ],
                 [
                     'name' => 'Horaires variables',
                     'value' => 'SCHEDULE_VARIABLE',
                 ],
                 [
                     'name' => 'Travail en 2x8',
                     'value' => 'SCHEDULE_2X8',
                 ],
                 [
                     'name' => 'Travail en 3x8',
                     'value' => 'SCHEDULE_3X8',
                 ],
                 [
                     'name' => 'Travail de nuit',
                     'value' => 'SCHEDULE_NIGHT',
                 ],
                 [
                     'name' => 'Travail le samedi',
                     'value' => 'SCHEDULE_SATURDAY',
                 ],
                 [
                     'name' => 'Travail le samedi et dimanche',
                     'value' => 'SCHEDULE_WEEKEND',
                 ],
             ]),
         ]);

         SiteList::create([
             'identifier' => 'offers_radios_licenses',
             'name' => 'Radios : Indifférent / Requis / Plus',
             'type' => 'radios',
             'value' => json_encode([
                 [
                     'name' => 'Indifférent',
                     'value' => 'OPTIONAL',
                 ],
                 [
                     'name' => 'Requis',
                     'value' => 'REQUIRED',
                 ],
                 [
                     'name' => 'C\'est un plus',
                     'value' => 'BETTER',
                 ],
             ]),
         ]);
         // ------------------------------------------------------ //

         // ------------------------------------------------------ //
         //  EMAIL TEMPLATES
         // ------------------------------------------------------ //
         EmailTemplate::create([
             'identifier' => 'application_refused',
             'subject' => 'Refus de candidature au poste postulé',
             'body' => 'Nous vous remercions de l’intérêt que vous avez manifesté vis-à-vis de notre entreprise et du poste proposé.
                        Après un examen attentif, nous avons le regret de vous informer que nous ne pouvons pas retenir votre candidature car votre profil ne répond pas aux critères exigés.  Nous vous souhaitons de trouver un emploi correspondant à votre expérience et à vos souhaits.
                        Nous vous prions d’agréer, Monsieur (ou) Madame, l’expression de nos meilleures salutations.',
         ]);

         EmailTemplate::create([
             'identifier' => 'application_accepted',
             'subject' => 'Votre candidature a été pré-selectionné !',
             'body' => 'Votre candidature a été pré-selectionné !',
         ]);

         EmailTemplate::create([
             'identifier' => 'application_new',
             'subject' => 'Votre candidature a été réceptionné',
             'body' => 'Nous  accusons réception de votre offre de collaboration et nous vous remercions de l’intérêt que vous portez à notre société.
                       Votre dossier sera traité dans les plus brefs délais.
                       Cependant, si vous n’avez pas de nouvelles de notre part dans les 15 jours qui suivent, veuillez considérer que nous ne sommes pas en mesure de répondre favorablement à votre candidature.',
         ]);

         EmailTemplate::create([
             'identifier' => 'application_new_interne',
             'subject' => 'Nouvelle candidature reçu',
             'body' => 'Nouvelle candidature reçu',
         ]);

         EmailTemplate::create([
             'identifier' => 'application_new_spontanee_interne',
             'subject' => 'Nouvelle candidature spontané reçu',
             'body' => 'Nous  accusons réception de votre offre de collaboration et nous vous remercions de l’intérêt que vous portez à notre société
                         Votre dossier sera traité dans les plus brefs délais.
                         Cependant, si vous n’avez pas de nouvelles de notre part dans les 15 jours qui suivent, veuillez considérer que nous ne sommes pas en mesure de répondre favorablement à votre candidature.',
         ]);

         // ------------------------------------------------------ //
     }
}
