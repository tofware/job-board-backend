<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\City;
use App\Models\County;
use App\Models\Employer;
use App\Models\EnumDefinition;
use App\Models\Enums;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);

        $usersEmployers = User::factory(50)->create(['role' => 'employer']);

        foreach ($usersEmployers as $user) {
            Employer::create([
                'user_id' => $user->id,
                'company_name' => fake()->company(),
                'company_website' => fake()->url(),
                'company_description' => fake()->paragraph(),
                'logo_path' => fake()->url(),
            ]);
        }

        $usersCandidates = User::factory(500)->create(['role' => 'candidate']);

        foreach ($usersCandidates as $user) {
            Candidate::create([
                'user_id' => $user->id,
                'full_name' => fake()->firstName(),
                'bio' => fake()->paragraph(),
                'resume_path' => fake()->url(),
                'skills' => json_encode(implode(', ', fake()->words(5))),
            ]);
        }

        $categories = [
            'Achiziții',
            'Administrativ / Logistică',
            'Agricultură',
            'Alimentație / HoReCa',
            'Altele',
            'Arhitectură / Design interior',
            'Asigurări',
            'Au pair / Babysitter / Curățenie',
            'Audit / Consultanță',
            'Auto / Echipamente',
            'Automatizări',
            'Bănci',
            'Cercetare - dezvoltare',
            'Chimie / Biochimie',
            'Confecții / Design vestimentar',
            'Construcții / Instalații',
            'Controlul calității',
            'Crewing / Casino / Entertainment',
            'Educație / Training / Arte',
            'Farmacie',
            'Financiar / Contabilitate',
            'Funcții publice',
            'Grafică / Webdesign / DTP',
            'Imobiliare',
            'Import - export',
            'Inginerie',
            'Instalații electrice',
            'Instalații sanitare',
            'Instalații termice',
            'Internet / e-Commerce',
            'IT Hardware',
            'IT Software',
            'Juridic',
            'Jurnalism / Editorial',
            'Management',
            'Marketing',
            'Medicină alternativă',
            'Medicină umană',
            'Medicină veterinară',
            'Merchandising / Promoteri',
            'MLM / Vânzări directe',
            'Naval / Aeronautic',
            'Office / Back-office / Secretariat',
            'ONG / Voluntariat',
            'Pază și protecție / Militar',
            'Personal calificat',
            'Petrol / Gaze',
            'Prelucrarea lemnului / PVC',
            'Producție',
            'Proiectare civilă / industrială',
            'Project Management',
            'Protecția mediului',
            'Protecția muncii',
            'Publicitate',
            'Relații clienți / Call center',
            'Relații publice',
            'Resurse umane / Psihologie',
            'Saloane / Clinici frumusețe',
            'Service / Reparații',
            'Specialiști / Tehnicieni',
            'Sport / Wellness',
            'Statistică / Matematică',
            'Telecomunicații',
            'Tipografii / Edituri',
            'Traduceri',
            'Transport / Distribuție',
            'Turism / Hotel staff',
        ];

        $counties = [
            'Alba', 'Arad', 'Arges', 'Bacau', 'Bihor', 'Bistrita-Nasaud', 'Botosani', 'Braila', 'Brasov',
            'Bucuresti', 'Buzau', 'Calarasi', 'Caras-Severin', 'Cluj', 'Constanta', 'Covasna', 'Dambovita',
            'Dolj', 'Galati', 'Giurgiu', 'Gorj', 'Harghita', 'Hunedoara', 'Ialomita', 'Iasi', 'Ilfov',
            'Maramures', 'Mehedinti', 'Mures', 'Neamt', 'Olt', 'Prahova', 'Salaj', 'Satu Mare', 'Sibiu',
            'Suceava', 'Teleorman', 'Timis', 'Tulcea', 'Vaslui', 'Valcea', 'Vrancea'
        ];

        foreach ($counties as $county) {
            $countModel = County::create(['name' => $county]);

            $cities = match ($county) {
                'Alba' => ['Alba Iulia', 'Sebeș', 'Aiud'],
                'Arad' => ['Arad', 'Pâncota', 'Ineu'],
                'Arges' => ['Pitești', 'Câmpulung', 'Mioveni'],
                'Bacau' => ['Bacău', 'Moinesti', 'Comănești'],
                'Bihor' => ['Oradea', 'Salonta', 'Beiuș'],
                'Bistrita-Nasaud' => ['Bistrița', 'Năsăud', 'Sângeorz-Băi'],
                'Botosani' => ['Botoșani', 'Dorohoi', 'Darabani'],
                'Braila' => ['Brăila', 'Însurăței', 'Făurei'],
                'Brasov' => ['Brașov', 'Făgăraș', 'Râșnov'],
                'Bucuresti' => ['București'],
                'Buzau' => ['Buzău', 'Râmnicu Sărat', 'Nehoiu'],
                'Calarasi' => ['Călărași', 'Oltenița', 'Budești'],
                'Caras-Severin' => ['Reșița', 'Caransebeș', 'Moldova Nouă'],
                'Cluj' => ['Cluj-Napoca', 'Turda', 'Câmpia Turzii'],
                'Constanta' => ['Constanța', 'Mangalia', 'Năvodari'],
                'Covasna' => ['Sfântu Gheorghe', 'Târgu Secuiesc', 'Baraolt'],
                'Dambovita' => ['Târgoviște', 'Moreni', 'Fieni'],
                'Dolj' => ['Craiova', 'Băilești', 'Filiași'],
                'Galati' => ['Galați', 'Tecuci', 'Târgu Bujor'],
                'Giurgiu' => ['Giurgiu', 'Bolintin-Vale', 'Mihăilești'],
                'Gorj' => ['Târgu Jiu', 'Motru', 'Rovinari'],
                'Harghita' => ['Miercurea Ciuc', 'Odorheiu Secuiesc', 'Toplița'],
                'Hunedoara' => ['Deva', 'Hunedoara', 'Orăștie'],
                'Ialomita' => ['Slobozia', 'Fetești', 'Urziceni'],
                'Iasi' => ['Iași', 'Pașcani', 'Hârlău'],
                'Ilfov' => ['București', 'Otopeni', 'Voluntari'],
                'Maramures' => ['Baia Mare', 'Sighetu Marmației', 'Târgu Lăpuș'],
                'Mehedinti' => ['Drobeta-Turnu Severin', 'Baia de Aramă', 'Șimian'],
                'Mures' => ['Târgu Mureș', 'Reghin', 'Sighișoara'],
                'Neamt' => ['Piatra Neamț', 'Târgu Neamț', 'Roman'],
                'Olt' => ['Slatina', 'Caracal', 'Craiova'],
                'Prahova' => ['Ploiești', 'Câmpina', 'Vălenii de Munte'],
                'Salaj' => ['Zalău', 'Șimleu Silvaniei', 'Jibou'],
                'Satu Mare' => ['Satu Mare', 'Carei', 'Negrești-Oaș'],
                'Sibiu' => ['Sibiu', 'Mediaș', 'Avrig'],
                'Suceava' => ['Suceava', 'Rădăuți', 'Câmpulung Moldovenesc'],
                'Teleorman' => ['Alexandria', 'Roșiorii de Vede', 'Turnu Măgurele'],
                'Timis' => ['Timișoara', 'Sânnicolau Mare', 'Jimbolia'],
                'Tulcea' => ['Tulcea', 'Măcin', 'Babadag'],
                'Vaslui' => ['Vaslui', 'Bârlad', 'Negrești'],
                'Valcea' => ['Râmnicu Vâlcea', 'Călimănești', 'Bălcești'],
                'Vrancea' => ['Focșani', 'Adjud', 'Mărășești'],
                default => []
            };

            foreach ($cities as $city) {
                City::create(['name' => $city, 'county_id' => $countModel->id]);
            }
        }

        foreach ($categories as $category) {
            Category::create(['name' => $category, 'slug' => Str::slug($category)]);
        }

        $applicationStatus = EnumDefinition::create([
            'title' => 'Application Status',
            'key' => 'APPLICATION_STATUS',
        ]);

        Enums::insert([
            ['enum_definition_id' => $applicationStatus->id, 'key' => 'PENDING', 'value' => 'Pending'],
            ['enum_definition_id' => $applicationStatus->id, 'key' => 'VIEWED', 'value' => 'Viewed'],
            ['enum_definition_id' => $applicationStatus->id, 'key' => 'APPROVED', 'value' => 'Approved'],
            ['enum_definition_id' => $applicationStatus->id, 'key' => 'REJECTED', 'value' => 'Rejected'],
        ]);

        $employmentType = EnumDefinition::create([
            'title' => 'Employment Type',
            'key' => 'EMPLOYMENT_TYPE',
        ]);

        Enums::insert([
            ['enum_definition_id' => $employmentType->id, 'key' => 'FULL_TIME', 'value' => 'Full-time'],
            ['enum_definition_id' => $employmentType->id, 'key' => 'PART_TIME', 'value' => 'Part-time'],
            ['enum_definition_id' => $employmentType->id, 'key' => 'CONTRACT', 'value' => 'Contract'],
            ['enum_definition_id' => $employmentType->id, 'key' => 'INTERNSHIP', 'value' => 'Internship'],
        ]);

        $employers = Employer::all();

        foreach ($employers as $employer) {
            for ($i = 0; $i < 5; $i++) {
                Position::create([
                    'employer_id' => $employer->id,
                    'category_id' => Category::inRandomOrder()->first()->id,
                    'city_id' => City::inRandomOrder()->first()->id,
                    'employment_type' => Enums::where('enum_definition_id', $employmentType->id)->inRandomOrder()->first()->id,
                    'title' => fake()->jobTitle(),
                    'description' => fake()->paragraphs(3, true),
                    'salary_min' => fake()->numberBetween(3000, 7000),
                    'salary_max' => fake()->numberBetween(7001, 15000),
                    'is_hybrid' => fake()->boolean(20),
                ]);
            }
        }

        $positions = Position::all();

        foreach($positions as $position) {
            $candidates = Candidate::inRandomOrder()->take(random_int(1, 25))->get();
            foreach ($candidates as $candidate) {
                Application::create([
                    'position_id' => $position->id,
                    'candidate_id' => $candidate->id,
                    'status' => Enums::where('enum_definition_id', $applicationStatus->id)->inRandomOrder()->first()->id,
                    'cover_letter_path' => fake()->url(),
                    'resume_path' => fake()->url(),
                ]);
            }
        }
    }
}
