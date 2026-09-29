<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Client;
use App\Models\Gallery;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\Setting;
use App\Models\ContactMessage;
use App\Models\Enquiry;

use Illuminate\Support\Facades\Schema;

class CorporateSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks for clean wiping of demo data
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Service::truncate();
        Project::truncate();
        Category::truncate();
        Testimonial::truncate();
        TeamMember::truncate();
        Client::truncate();
        Gallery::truncate();
        Blog::truncate();
        BlogCategory::truncate();
        Setting::truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Executive Admin Users
        User::updateOrCreate(
            ['email' => 'admin@maisagrohouse.com'],
            [
                'name' => 'Mais Agro Executive Admin',
                'password' => Hash::make('Password@123'),
                'role' => 'admin',
                'phone' => '+91 80080 07062',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@harshmais.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Password@123'),
                'role' => 'admin',
                'phone' => '+91 90090 08014',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'is_active' => true,
            ]
        );

        // 2. Comprehensive Settings - Exact Real Data from maisagrohouse.com
        $settings = [
            ['group' => 'general', 'key' => 'site_name', 'value' => 'Mais Agro House', 'label' => 'Site Name', 'type' => 'text'],
            ['group' => 'general', 'key' => 'site_tagline', 'value' => 'Apartments, Residential Plots & Farmland Investment in Bhubaneswar', 'label' => 'Tagline', 'type' => 'text'],
            ['group' => 'general', 'key' => 'site_established', 'value' => '2015', 'label' => 'Established Year', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'contact_email', 'value' => 'info@maisagrohouse.com', 'label' => 'Primary Email', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'sales_email', 'value' => 'sales@maisagrohouse.com', 'label' => 'Sales Email', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'contact_phone', 'value' => '+91 80080 07062', 'label' => 'Primary Phone', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'contact_phone_alt', 'value' => '+91 90090 08014', 'label' => 'Secondary Phone', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'whatsapp_number', 'value' => '918008007062', 'label' => 'WhatsApp Number', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'whatsapp_number_alt', 'value' => '919009008014', 'label' => 'Secondary WhatsApp Number', 'type' => 'text'],
            ['group' => 'contact', 'key' => 'contact_address', 'value' => 'Bhubaneswar patia raghunathpur nanadankanan road 751024 odisha Landmark Punjab National Bank', 'label' => 'Head Office Address', 'type' => 'textarea'],
            ['group' => 'contact', 'key' => 'mumbai_branch', 'value' => 'Bhubaneswar Patia Raghunathpur Nandankanan Road 751024 Odisha Landmark Punjab National Bank', 'label' => 'Branch Address', 'type' => 'textarea'],
            ['group' => 'contact', 'key' => 'office_hours', 'value' => 'Mon - Sun: 09:00 AM - 07:00 PM', 'label' => 'Office Hours', 'type' => 'text'],
            ['group' => 'social', 'key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/maisagrohouse', 'label' => 'LinkedIn URL', 'type' => 'text'],
            ['group' => 'social', 'key' => 'social_twitter', 'value' => 'https://twitter.com/maisagrohouse', 'label' => 'X / Twitter URL', 'type' => 'text'],
            ['group' => 'social', 'key' => 'social_facebook', 'value' => 'https://www.facebook.com/profile.php?id=61577536583866', 'label' => 'Facebook URL', 'type' => 'text'],
            ['group' => 'social', 'key' => 'social_instagram', 'value' => 'https://www.instagram.com/maisagrohouse/', 'label' => 'Instagram URL', 'type' => 'text'],
            ['group' => 'social', 'key' => 'social_youtube', 'value' => 'https://youtube.com', 'label' => 'YouTube URL', 'type' => 'text'],
            ['group' => 'stats', 'key' => 'stat_years', 'value' => '10+', 'label' => 'Years of Trust & Excellence', 'type' => 'text'],
            ['group' => 'stats', 'key' => 'stat_projects', 'value' => '250+', 'label' => 'Verified Layouts & Plots', 'type' => 'text'],
            ['group' => 'stats', 'key' => 'stat_clients', 'value' => '1,200+', 'label' => 'Happy Families & Investors', 'type' => 'text'],
            ['group' => 'stats', 'key' => 'stat_tonnage', 'value' => '100%', 'label' => 'Clear Legal Titles & Mutation', 'type' => 'text'],
            ['group' => 'stats', 'key' => 'stat_acreage', 'value' => '500+', 'label' => 'Acres Developed in Bhubaneswar', 'type' => 'text'],
            ['group' => 'appearance', 'key' => 'hero_badge', 'value' => 'TRUSTED REAL ESTATE SOLUTIONS IN BHUBANESWAR', 'label' => 'Hero Badge', 'type' => 'text'],
            ['group' => 'appearance', 'key' => 'hero_title', 'value' => 'Land, Lifestyle & Long-Term Value', 'label' => 'Hero Title', 'type' => 'text'],
            ['group' => 'appearance', 'key' => 'hero_subtitle', 'value' => 'MAIS AGRO HOUSE is a trusted real estate company based in Bhubaneswar, Odisha, providing apartments, residential plots, and investment properties with complete legal transparency.', 'label' => 'Hero Subtitle', 'type' => 'textarea'],
            ['group' => 'appearance', 'key' => 'footer_about', 'value' => 'MAIS AGRO HOUSE is a trusted real estate company based in Bhubaneswar, Odisha, specializing in apartments, residential plots, and farmland investment opportunities. We provide legally verified properties with transparent pricing and professional guidance.', 'label' => 'Footer About Text', 'type' => 'textarea'],
            ['group' => 'seo', 'key' => 'default_meta_title', 'value' => 'Mais Agro House | Apartments, Residential Plots & Farmland in Bhubaneswar', 'label' => 'Default Meta Title', 'type' => 'text'],
            ['group' => 'seo', 'key' => 'default_meta_description', 'value' => 'Find your perfect home and high-value land investments in Bhubaneswar with Mais Agro House. Legally verified apartments, residential plots, and agricultural estates on Nandankanan Road, Patia.', 'label' => 'Default Meta Description', 'type' => 'textarea'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }

        // 3. Property Categories
        $categoriesData = [
            [
                'name' => 'Apartments & Residential',
                'slug' => 'apartments-residential',
                'type' => 'product',
                'description' => 'Well-planned communities and modern luxury residential apartments with complete lifestyle amenities in Bhubaneswar.',
                'image' => '/images/properties/apartment-exterior.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Residential Plots',
                'slug' => 'residential-plots',
                'type' => 'product',
                'description' => 'Legally verified residential land parcels with blacktop roads, boundary walls, and instant mutation readiness.',
                'image' => '/images/properties/residential-plots.jpg',
                'order' => 2,
            ],
            [
                'name' => 'Farm Land Investment',
                'slug' => 'farm-land-investment',
                'type' => 'product',
                'description' => 'Fertile agricultural land parcels and managed agro-farms offering tranquility and long-term capital appreciation.',
                'image' => '/images/properties/farmland-green.jpg',
                'order' => 3,
            ],
            [
                'name' => 'Investment Properties',
                'slug' => 'investment-properties',
                'type' => 'product',
                'description' => 'High-potential commercial and development land parcels situated on booming infrastructure corridors.',
                'image' => '/images/properties/commercial-tower.jpg',
                'order' => 4,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $c) {
            $categories[$c['slug']] = Category::create($c);
        }

        // 4. Real Estate Properties (Products)
        $productsData = [
            [
                'category_id' => $categories['apartments-residential']->id,
                'name' => 'Luxury Residential Apartments - Patia Nandankanan Road',
                'slug' => 'luxury-residential-apartments-patia-nandankanan',
                'sku' => 'MAH-APT-01',
                'tagline' => 'Well-Planned Communities for Modern Living',
                'short_description' => 'Modern residential apartments with premium lifestyle amenities, legal clearance, and high rental yield in Patia, Bhubaneswar.',
                'description' => "MAIS AGRO HOUSE is proud to present premier residential apartments situated right along the prestigious Patia - Nandankanan corridor in Bhubaneswar.\n\nDesigned for modern families seeking a balanced lifestyle, these apartments feature thoughtful architectural planning, abundant natural light, and top-tier community facilities. Every unit is legally verified with clear title deeds and regulatory clearances.\n\nWhether you are looking for your primary family home or a rental income-generating asset, this development offers unparalleled value, connectivity to premier IT hubs like Infocity, educational institutions, and healthcare centers.",
                'features' => [
                    'Library & Study Lounge',
                    'Commercial Complex & Daily Needs',
                    'Fountain & Landscaped Gardens',
                    'Dedicated Jogging Track',
                    'Clock Tower Community Landmark',
                    'In-house Medical Centre',
                    'Miniplex / Community Cinema Room',
                    '24/7 Gated Security with CCTV',
                ],
                'specifications' => [
                    'Unit Type' => 'Residential Apartment',
                    'Configurations' => '2 BHK, 3 BHK & Penthouse Suites',
                    'Location' => 'Patia - Raghunathpur - Nandankanan Road, Bhubaneswar',
                    'Landmark' => 'Near Punjab National Bank',
                    'Possession' => 'Ready to Move & Under Construction Options',
                    'Flooring' => 'Premium Vitrified Tiles',
                    'Power Backup' => '100% DG Backup for Common Areas',
                    'Approval' => 'Fully Approved with Clear Title Deeds',
                ],
                'applications' => [
                    'Family Living & Primary Residence',
                    'High-Yield Rental Investment for IT Professionals',
                    'Long-Term Capital Appreciation Asset',
                ],
                'price_range' => '₹45,00,000 - ₹1,20,00,000',
                'featured_image' => '/images/properties/apartment-exterior.jpg',
                'gallery' => [
                    '/images/properties/apartment-exterior.jpg',
                    '/images/properties/apartment-interior.jpg',
                    '/images/properties/luxury-estate.jpg',
                ],
                'is_featured' => true,
                'status' => true,
                'order' => 1,
                'meta_title' => 'Residential Apartments in Patia Bhubaneswar | Mais Agro House',
                'meta_description' => 'Explore luxury residential apartments in Patia Nandankanan Road, Bhubaneswar. 2 BHK & 3 BHK with library, jogging track, and 24/7 security.',
            ],
            [
                'category_id' => $categories['residential-plots']->id,
                'name' => 'Legally Verified Residential Plots - Raghunathpur',
                'slug' => 'legally-verified-residential-plots-raghunathpur',
                'sku' => 'MAH-PLT-02',
                'tagline' => '100% Clear Title Plots Ready for Home Construction',
                'short_description' => 'Ready-to-build residential plots in Raghunathpur, Bhubaneswar with 30ft wide blacktop roads, electricity, and immediate mutation.',
                'description' => "Secure your family's future with 100% legally verified residential plots offered by MAIS AGRO HOUSE in Raghunathpur, Bhubaneswar.\n\nOur residential layout is thoughtfully designed with wide internal blacktop roads, individual plot demarcation, drainage provisions, and electrical connectivity. Every plot undergoes a strict 30-year title search by our legal team, ensuring zero disputes, zero encumbrances, and seamless registration.\n\nBuild your customized dream villa in an upscale, rapidly growing neighborhood surrounded by reputed schools, hospitals, and shopping centers.",
                'features' => [
                    '100% Legally Verified Title Deeds',
                    '30 Feet Wide Blacktop Internal Roads',
                    'Clear Boundary Wall & Demarcation Pillars',
                    'Underground Electricity Line Provisions',
                    'Drainage & Rainwater Harvesting System',
                    'Immediate Spot Registration & Mutation Support',
                    'Gated Society with Security Post',
                ],
                'specifications' => [
                    'Unit Type' => 'Residential Land / Plot',
                    'Plot Sizes' => '1,200 Sq.Ft, 1,800 Sq.Ft, 2,400 Sq.Ft & 3,600 Sq.Ft',
                    'Facing Options' => 'East, North, North-East & Corner Plots',
                    'Road Width' => '30 Feet & 40 Feet Connecting Roads',
                    'Location' => 'Raghunathpur, Nandankanan Road, Bhubaneswar 751024',
                    'Documentation' => '30-Year Chain Deed & Encumbrance Free Certificate',
                ],
                'applications' => [
                    'Independent Bungalow & Villa Construction',
                    'Multi-Story Rental Property Development',
                    'Safe Low-Risk Land Investment with Rapid Value Growth',
                ],
                'price_range' => '₹1,950 - ₹2,750 per Sq.Ft',
                'featured_image' => '/images/properties/residential-plots.jpg',
                'gallery' => [
                    '/images/properties/residential-plots.jpg',
                    '/images/properties/luxury-villa.jpg',
                    '/images/maisagro/property-3.jpeg',
                ],
                'is_featured' => true,
                'status' => true,
                'order' => 2,
                'meta_title' => 'Residential Plots for Sale in Raghunathpur Bhubaneswar | Mais Agro House',
                'meta_description' => 'Buy legally verified residential plots in Raghunathpur, Nandankanan Road Bhubaneswar. Instant mutation, clear titles, 30ft roads.',
            ],
            [
                'category_id' => $categories['farm-land-investment']->id,
                'name' => 'High-Yield Farm Land Investment Parcels',
                'slug' => 'high-yield-farm-land-investment-parcels',
                'sku' => 'MAH-FRM-03',
                'tagline' => 'Sustainable Agriculture, Leisure Farming & Capital Appreciation',
                'short_description' => 'Fertile agricultural land parcels with all-weather road access, sweet groundwater, and complete boundary fencing near Bhubaneswar.',
                'description' => "MAIS AGRO HOUSE specializes in helping individuals and investors discover secure, high-potential farmland opportunities.\n\nOur farmland investment parcels combine rich agricultural productivity with long-term land value appreciation. Each parcel is surveyed, fenced, and equipped with dependable water resources and road access.\n\nWhether your ambition is to cultivate organic crops, establish a weekend farmhouse retreat, or hedge against inflation through tangible farmland ownership, our team provides full end-to-end management, documentation, and plantation advisory.",
                'features' => [
                    'Fertile Soil Suitable for Horticulture & Timber',
                    'All-Weather Motor-able Road Connectivity',
                    'Solar Powered Borewell & Irrigation Access',
                    'Boundary Fencing with Dedicated Caretaker Staff',
                    'Complete Legal Documentation & Revenue Records',
                    'Hassle-Free Title Transfer & Mutation Support',
                ],
                'specifications' => [
                    'Unit Type' => 'Agricultural Land / Farm Land',
                    'Parcel Sizes' => '0.5 Acre, 1.0 Acre, 2.5 Acres & 5.0+ Acres',
                    'Water Source' => 'Sweet Groundwater Borewell & Canal Access',
                    'Soil Type' => 'Alluvial Red & Loamy Fertile Soil',
                    'Location' => 'Bhubaneswar Agro-Corridor & Nandankanan Outskirts',
                    'Legal Status' => 'Agricultural Clearance with Clear Title',
                ],
                'applications' => [
                    'Organic Farming & High-Value Horticulture',
                    'Weekend Farmhouse & Family Nature Retreat',
                    'Long-Term Generational Wealth Land Banking',
                ],
                'price_range' => '₹18,00,000 - ₹45,00,000 per Acre',
                'featured_image' => '/images/properties/farmland-green.jpg',
                'gallery' => [
                    '/images/properties/farmland-green.jpg',
                    '/images/maisagro/about-us.webp',
                    '/images/properties/luxury-estate.jpg',
                ],
                'is_featured' => true,
                'status' => true,
                'order' => 3,
                'meta_title' => 'Farmland Investment in Bhubaneswar | Mais Agro House',
                'meta_description' => 'Invest in secure, legally verified farmland parcels in Bhubaneswar with Mais Agro House. Fertile soil, water access, and high capital growth.',
            ],
            [
                'category_id' => $categories['investment-properties']->id,
                'name' => 'Strategic Commercial & Growth Corridor Land',
                'slug' => 'strategic-commercial-growth-corridor-land',
                'sku' => 'MAH-COM-04',
                'tagline' => 'Prime Commercial Exposure on High-Traffic Arterial Road',
                'short_description' => 'Commercial development land parcels situated on expanding Bhubaneswar growth corridors, ideal for retail, office complexes, or institutions.',
                'description' => "For enterprises and institutional investors seeking high-impact commercial presence in Bhubaneswar, MAIS AGRO HOUSE presents strategic commercial land opportunities.\n\nPositioned along prime commercial corridors with expansive main-road frontage, these parcels are primed for retail complexes, commercial showrooms, corporate offices, healthcare facilities, or logistics warehousing.\n\nEvery commercial land parcel undergoes meticulous zoning verification, master plan alignment, and title scrutiny to guarantee seamless development clearances.",
                'features' => [
                    'Prominent Main Road Frontage & High Footfall Corridor',
                    'Zoning Verification for Commercial & Mixed-Use Development',
                    'Wide Heavy-Vehicle Ingress & Egress Points',
                    'Comprehensive 30-Year Legal Due Diligence',
                    'High Capital Appreciation & Exceptional Rental Potential',
                ],
                'specifications' => [
                    'Unit Type' => 'Commercial & Institutional Land',
                    'Parcels' => '5,000 Sq.Ft up to 2.5 Acres',
                    'Frontage' => '60 Feet to 150+ Feet Main Road Frontage',
                    'Location' => 'Patia - Nandankanan Arterial Highway, Bhubaneswar',
                    'Zoning' => 'Commercial / Mixed Use',
                ],
                'applications' => [
                    'Commercial Showrooms & Retail Outlets',
                    'Corporate Offices & IT Hub Facilities',
                    'Hospitals, Diagnostic Centers & Educational Institutes',
                ],
                'price_range' => 'Price on Request (Custom Parcels)',
                'featured_image' => '/images/properties/commercial-tower.jpg',
                'gallery' => [
                    '/images/properties/commercial-tower.jpg',
                    '/images/maisagro/property-2.jpeg',
                    '/images/properties/apartment-exterior.jpg',
                ],
                'is_featured' => true,
                'status' => true,
                'order' => 4,
                'meta_title' => 'Commercial Land for Sale in Bhubaneswar | Mais Agro House',
                'meta_description' => 'Prime commercial land parcels for sale on Nandankanan Road, Patia Bhubaneswar. Clear titles, high frontage, perfect for retail & corporate complexes.',
            ],
        ];

        foreach ($productsData as $p) {
            Product::create($p);
        }

        // 5. Authentic Services (from maisagrohouse.com)
        $servicesData = [
            [
                'title' => 'Legally Verified Property Due Diligence',
                'slug' => 'legally-verified-property-due-diligence',
                'icon' => 'bi-shield-check',
                'tagline' => '100% Legal Transparency & Title Clarity',
                'short_description' => 'Every property we offer is thoroughly verified through government records, 30-year search reports, and encumbrance-free certification.',
                'description' => "At MAIS AGRO HOUSE, legal transparency is our founding principle. We understand that purchasing real estate is one of the most critical financial decisions in your life.\n\nOur in-house team of senior advocates and land revenue specialists conducts exhaustive due diligence on every apartment, residential plot, and farmland parcel before it is presented to buyers. We examine 30-year chain deeds, ensure clear ownership lineage, verify government land record mutations (RoR), and obtain official Encumbrance Certificates (EC).\n\nWhen you buy through Mais Agro House, you invest with complete peace of mind.",
                'features' => [
                    '30-Year Historical Title & Chain Deed Search',
                    'Government Revenue Department Record (RoR) Verification',
                    'Official Non-Encumbrance Certificate (EC) Procurement',
                    'RERA & Master Plan Zone Compliance Verification',
                    'Demarcation & Physical Boundary Inspection',
                ],
                'benefits' => [
                    'Eliminate legal disputes and unauthorized claims completely',
                    'Guaranteed clear ownership transfer and prompt mutation',
                    'Eligibility for smooth nationalized bank home loans',
                ],
                'process_steps' => [
                    ['step' => '1', 'title' => 'Record Retrieval', 'desc' => 'Procure certified copies of all prior title deeds from the Sub-Registrar.'],
                    ['step' => '2', 'title' => 'Revenue Audit', 'desc' => 'Cross-verify mutation status and tenant ledger entries in the Tehsil office.'],
                    ['step' => '3', 'title' => 'Physical Demarcation', 'desc' => 'Surveyor verifies plot coordinates and boundary alignment with master maps.'],
                    ['step' => '4', 'title' => 'Legal Clearance Certificate', 'desc' => 'Provide client with complete search report and certified documentation.'],
                ],
                'featured_image' => '/images/properties/luxury-villa.jpg',
                'is_featured' => true,
                'status' => true,
                'order' => 1,
            ],
            [
                'title' => 'Complete Support from Inquiry to Registration',
                'slug' => 'support-from-inquiry-to-registration',
                'icon' => 'bi-file-earmark-text',
                'tagline' => 'Seamless Documentation, Stamp Duty & Sub-Registrar Support',
                'short_description' => 'Our experienced team assists clients throughout the entire buying journey, including site visits, transparent pricing, and registration support.',
                'description' => "Navigating real estate documentation and government registration can often feel overwhelming. MAIS AGRO HOUSE provides dedicated end-to-end facilitation for every customer.\n\nFrom the moment you contact our office to the day you receive your registered sale deed and updated mutation certificate, our client coordinators handle every administrative detail.\n\nWe prepare transparent sale agreements, calculate precise stamp duty, manage Sub-Registrar appointments, and oversee the formal land mutation process with local revenue authorities.",
                'features' => [
                    'Transparent Agreement Drafting without Hidden Clauses',
                    'Accurate Stamp Duty & Registration Fee Assessment',
                    'Sub-Registrar Office Coordination & Appointment Scheduling',
                    'Official Tehsildar Mutation & Record of Rights (RoR) Follow-up',
                    'Secure Physical Deed Handover & Digital Copy Archiving',
                ],
                'benefits' => [
                    'Zero stress or confusion during government registration',
                    'Transparent pricing with no hidden brokerage or commission',
                    'Timely issuance of mutation and land revenue passbook',
                ],
                'process_steps' => [
                    ['step' => '1', 'title' => 'Booking Agreement', 'desc' => 'Transparent terms drafted and signed with mutual confirmation.'],
                    ['step' => '2', 'title' => 'Challan & Duty Preparation', 'desc' => 'E-stamping and treasury challans completed via government portals.'],
                    ['step' => '3', 'title' => 'Sub-Registrar Execution', 'desc' => 'Personal assistance during biometric verification and deed execution.'],
                    ['step' => '4', 'title' => 'Revenue Mutation', 'desc' => 'Application filed in Tehsil for immediate mutation into the buyer\'s name.'],
                ],
                'featured_image' => '/images/properties/apartment-interior.jpg',
                'is_featured' => true,
                'status' => true,
                'order' => 2,
            ],
            [
                'title' => 'Guided Site Visits & Layout Inspections',
                'slug' => 'guided-site-visits-layout-inspections',
                'icon' => 'bi-geo-alt',
                'tagline' => 'Experience Your Future Property First-Hand with Our Experts',
                'short_description' => 'We arrange dedicated site visits with knowledgeable property managers who explain boundaries, infrastructure, and growth potential.',
                'description' => "Choosing the right land or apartment requires seeing it in person. MAIS AGRO HOUSE offers complimentary, personalized site visits for all prospective buyers.\n\nOur property specialists accompany you to the location, walk you through the physical boundaries, explain layout dimensions, demonstrate road widths, and detail surrounding civic infrastructure such as upcoming metro routes, educational institutions, and shopping centers.\n\nWe believe in complete transparency, ensuring you have every fact before making an investment decision.",
                'features' => [
                    'Complimentary Chauffeur-Driven Property Site Tours',
                    'On-Site Physical Demarcation & Boundary Pillar Checks',
                    'Detailed Walkthrough of Layout Amenities & Infrastructure',
                    'Neighborhood Connectivity & Infrastructure Outlook Presentation',
                    'No Obligation Consultations with Senior Property Consultants',
                ],
                'benefits' => [
                    'Gain total clarity on the exact plot location and surroundings',
                    'Inspect actual road widths, electricity, and water infrastructure',
                    'Direct interaction with property managers without intermediaries',
                ],
                'process_steps' => [
                    ['step' => '1', 'title' => 'Schedule Tour', 'desc' => 'Pick your convenient date and time via phone, WhatsApp, or website.'],
                    ['step' => '2', 'title' => 'Site Orientation', 'desc' => 'Inspect plot boundaries, soil quality, and community master plan.'],
                    ['step' => '3', 'title' => 'Q&A with Manager', 'desc' => 'Review legal records, approved layout maps, and payment plans.'],
                ],
                'featured_image' => '/images/properties/residential-plots.jpg',
                'is_featured' => true,
                'status' => true,
                'order' => 3,
            ],
            [
                'title' => 'Farmland Investment & Strategic Land Advisory',
                'slug' => 'farmland-investment-strategic-land-advisory',
                'icon' => 'bi-tree',
                'tagline' => 'Secure High-Value Farmland & Generational Wealth Creation',
                'short_description' => 'Expert guidance to help individuals and investors find secure and valuable land opportunities for residential development, farming, and long-term investment.',
                'description' => "Land is the world's most enduring asset. MAIS AGRO HOUSE provides specialized investment advisory for buyers looking to build lasting wealth through farmland and strategic land parcels.\n\nWe identify high-growth corridors surrounding Bhubaneswar that are primed for rapid infrastructure expansion. Our team assists with soil testing, organic farming feasibility, timber plantation planning, boundary security, and long-term asset management.\n\nWhether you desire an active agricultural estate or a hands-off land banking portfolio, we provide the guidance needed to maximize your capital appreciation.",
                'features' => [
                    'Strategic Land Corridor Scouting & Appreciation Forecasting',
                    'Agricultural Soil Fertility & Ground Water Yield Testing',
                    'Agro-Forestry & Managed Plantation Planning',
                    'Fencing, Boundary Wall & Site Security Solutions',
                    'Flexible Land Parcel Sizing from 0.5 Acre to Multi-Acre Holdings',
                ],
                'benefits' => [
                    'Capitalize on Bhubaneswar\'s expanding urbanization ring roads',
                    'Tangible, inflation-beating asset with agricultural tax benefits',
                    'Professional guidance on sustainable agro-farming models',
                ],
                'process_steps' => [
                    ['step' => '1', 'title' => 'Investor Profiling', 'desc' => 'Understand your investment horizon, budget, and purpose.'],
                    ['step' => '2', 'title' => 'Corridor Selection', 'desc' => 'Present legally vetted farmland parcels with maximum ROI potential.'],
                    ['step' => '3', 'title' => 'Acquisition & Handover', 'desc' => 'Execute registration with clear demarcation and boundary security.'],
                ],
                'featured_image' => '/images/properties/farmland-green.jpg',
                'is_featured' => true,
                'status' => true,
                'order' => 4,
            ],
        ];

        foreach ($servicesData as $s) {
            Service::create($s);
        }

        // 6. Authentic Testimonials (Direct from maisagrohouse.com)
        $testimonialsData = [
            [
                'client_name' => 'Rakesh Mehta',
                'client_title' => 'Property Buyer',
                'company' => 'Kolkata',
                'rating' => 5,
                'content' => 'MAIS AGRO HOUSE helped us find a residential plot with complete legal clarity. The team explained every document and supported us during the entire process, from site visit to registration. Their transparent approach made us feel confident about our investment. Highly recommended for anyone looking for secure land opportunities.',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'project_reference' => 'Residential Plot in Raghunathpur',
                'order' => 1,
                'status' => true,
            ],
            [
                'client_name' => 'Ananya Kapoor',
                'client_title' => 'Investor',
                'company' => 'Bhubaneswar',
                'rating' => 5,
                'content' => 'I was looking for a reliable real estate company for long-term land investment. MAIS AGRO HOUSE provided excellent guidance, clear documentation, and honest advice. The property options were well planned and legally verified, which made the decision much easier. Their professional support throughout the process was impressive.',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'project_reference' => 'Farmland Investment Parcel',
                'order' => 2,
                'status' => true,
            ],
            [
                'client_name' => 'Riya Jain',
                'client_title' => 'Homeowner',
                'company' => 'Hyderabad',
                'rating' => 5,
                'content' => 'The team at MAIS AGRO HOUSE made buying property a smooth experience. They arranged a proper site visit, explained pricing transparently, and assisted with documentation and registration. Their professionalism and customer support gave us complete confidence in our investment.',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80',
                'project_reference' => 'Patia Residential Apartment',
                'order' => 3,
                'status' => true,
            ],
        ];

        foreach ($testimonialsData as $t) {
            Testimonial::create($t);
        }

        // 7. Projects Portfolio
        $projectsData = [
            [
                'title' => 'Mais Commercial Gateway',
                'slug' => 'mais-commercial-gateway',
                'client_name' => 'Commercial Infrastructure',
                'location' => 'Patia-Nandankanan Road, Bhubaneswar',
                'sector' => 'Commercial Development',
                'completion_date' => '2026-01-30',
                'budget' => '₹31.5 Cr',
                'scope' => 'High-visibility commercial land and retail plaza project with 120ft main road frontage designed for showrooms, shopping arcade, commercial banks, and corporate offices.',
                'challenge' => 'Securing commercial zoning conversions and traffic flow clearances along a bustling arterial corridor.',
                'solution' => 'Coordinated comprehensive development plans with BDA/BMC urban authorities, ensuring ample parking setbacks, modern multi-tier storefronts, and service lanes.',
                'results' => 'Attracted premier banking institutions including Punjab National Bank landmark and corporate retail brands.',
                'featured_image' => 'images/projects/commercial-gateway.png',
                'gallery' => [
                    'images/projects/commercial-gateway.png',
                    'images/properties/commercial-tower.jpg',
                    'images/hero-banner.png',
                ],
                'is_featured' => true,
                'status' => true,
                'order' => 1,
            ],
            [
                'title' => 'Mais Agro Enclave - Patia',
                'slug' => 'mais-agro-enclave-patia',
                'client_name' => 'Plotted Community Development',
                'location' => 'Patia, Bhubaneswar, Odisha',
                'sector' => 'Residential Plots',
                'completion_date' => '2025-11-15',
                'budget' => '₹18.5 Cr',
                'scope' => '35-acre gated residential plotted community featuring 30ft paved blacktop roads, underground electricity cabling, dedicated drainage, and lush green boundary fencing.',
                'challenge' => 'Ensuring comprehensive legal validation across multiple ancestral parcels and obtaining zero-encumbrance revenue certification for every individual sub-plot.',
                'solution' => 'Conducted thorough 30-year genealogy title searches, secured Tehsildar mutation clearances, and executed boundary pillar demarcation with laser precision.',
                'results' => '100% of plots registered with instant mutation for over 180 happy homeowners with zero disputes.',
                'featured_image' => 'images/properties/residential-plots.jpg',
                'is_featured' => true,
                'status' => true,
                'order' => 2,
            ],
            [
                'title' => 'Mais Royal Heights Apartment Complex',
                'slug' => 'mais-royal-heights-apartment-complex',
                'client_name' => 'Urban Residential Living',
                'location' => 'Raghunathpur, Nandankanan Road, Bhubaneswar',
                'sector' => 'Apartments',
                'completion_date' => '2026-03-20',
                'budget' => '₹42.0 Cr',
                'scope' => 'Modern multi-story residential enclave offering 2 BHK, 3 BHK, and duplex apartments equipped with library, jogging track, commercial complex, and dedicated medical center.',
                'challenge' => 'Designing an integrated eco-friendly residential community that blends urban convenience with natural landscaped greenery.',
                'solution' => 'Engineered high-efficiency floor layouts, central fountain plaza, rainwater harvesting systems, and solar-powered common utility illumination.',
                'results' => 'Over 85% pre-booking achieved with top ratings from resident buyers.',
                'featured_image' => 'images/properties/apartment-exterior.jpg',
                'is_featured' => true,
                'status' => true,
                'order' => 3,
            ],
            [
                'title' => 'Mais Green Acres Farmland Estate',
                'slug' => 'mais-green-acres-farmland-estate',
                'client_name' => 'Agro-Farmland & Retreat',
                'location' => 'Bhubaneswar Agro-Corridor',
                'sector' => 'Farm Land Investment',
                'completion_date' => '2025-08-10',
                'budget' => '₹24.0 Cr',
                'scope' => '120-acre sustainable agricultural land development parcel partitioned into 1-acre and 2-acre managed farmlands with water borewells and perimeter fencing.',
                'challenge' => 'Transforming raw land into well-demarcated, high-fertility farmland parcels accessible by all-weather roads.',
                'solution' => 'Constructed heavy-gravel access roads, drilled deep solar-powered borewells, and implemented organic soil enrichment protocols.',
                'results' => 'Delivered 65+ managed agricultural plots to investors seeking both weekend retreats and high long-term land value appreciation.',
                'featured_image' => 'images/properties/farmland-green.jpg',
                'is_featured' => true,
                'status' => true,
                'order' => 4,
            ],
        ];

        foreach ($projectsData as $proj) {
            Project::create($proj);
        }

        // 8. Real Team Members
        $teamData = [
            [
                'name' => 'Er. Manish Kumar',
                'designation' => 'Founder & Managing Director',
                'department' => 'Executive Leadership',
                'bio' => 'Visionary real estate leader committed to bringing total legal transparency, ethical land development, and modern community planning to Bhubaneswar.',
                'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80',
                'email' => 'manish@maisagrohouse.com',
                'order' => 1,
                'status' => true,
            ],
            [
                'name' => 'Adv. S. P. Mohanty',
                'designation' => 'Head of Legal Due Diligence',
                'department' => 'Legal & Land Revenue',
                'bio' => 'Senior revenue advocate with over 22 years of expertise in Odisha land records, Record of Rights (RoR) verification, and 30-year chain deed analysis.',
                'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
                'email' => 'legal@maisagrohouse.com',
                'order' => 2,
                'status' => true,
            ],
            [
                'name' => 'Rajesh Pattnaik',
                'designation' => 'Director of Site Operations & Acquisition',
                'department' => 'Project Execution',
                'bio' => 'Leads land parcel surveying, layout engineering, road infrastructure development, and physical boundary demarcation across Bhubaneswar.',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'email' => 'projects@maisagrohouse.com',
                'order' => 3,
                'status' => true,
            ],
            [
                'name' => 'Priya Dash',
                'designation' => 'Head of Client Relations & Documentation',
                'department' => 'Customer Experience',
                'bio' => 'Ensures every customer enjoys a smooth, confident property buying experience from initial inquiry and site visit to Sub-Registrar deed registration.',
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
                'email' => 'priya@maisagrohouse.com',
                'order' => 4,
                'status' => true,
            ],
        ];

        foreach ($teamData as $m) {
            TeamMember::create($m);
        }

        // 9. Gallery Items
        $galleryData = [
            [
                'title' => 'Luxury Modern Apartment Residences',
                'category' => 'Apartments',
                'image' => '/images/properties/apartment-exterior.jpg',
                'description' => 'Architectural overview of modern residential apartments on Nandankanan Road.',
                'order' => 1,
                'status' => true,
            ],
            [
                'title' => 'Verified Residential Plots Demarcation',
                'category' => 'Residential Plots',
                'image' => '/images/properties/residential-plots.jpg',
                'description' => 'Clear boundary wall demarcation and blacktop internal roads in Raghunathpur layout.',
                'order' => 2,
                'status' => true,
            ],
            [
                'title' => 'Fertile Agricultural Farmland Parcels',
                'category' => 'Farmland',
                'image' => '/images/properties/farmland-green.jpg',
                'description' => 'Lush green agricultural parcels with borewell water supply and perimeter security.',
                'order' => 3,
                'status' => true,
            ],
            [
                'title' => 'Prime Commercial Highway Frontage',
                'category' => 'Commercial',
                'image' => '/images/properties/commercial-tower.jpg',
                'description' => 'Strategic commercial property on high-traffic main road frontage in Bhubaneswar.',
                'order' => 4,
                'status' => true,
            ],
            [
                'title' => 'Modern Luxury Apartment Interiors',
                'category' => 'Apartments',
                'image' => '/images/properties/apartment-interior.jpg',
                'description' => 'Spacious open-concept living lounge with premium vitrified flooring and balcony view.',
                'order' => 5,
                'status' => true,
            ],
            [
                'title' => 'Contemporary Gated Community Villa',
                'category' => 'Residential Plots',
                'image' => '/images/properties/luxury-villa.jpg',
                'description' => 'Customized architectural villa development within gated residential society.',
                'order' => 6,
                'status' => true,
            ],
        ];

        foreach ($galleryData as $g) {
            Gallery::create($g);
        }

        // 10. Real Estate Blog Categories & Insights
        $blogCat1 = BlogCategory::create([
            'name' => 'Land Legal Guidance',
            'slug' => 'land-legal-guidance',
            'description' => 'Crucial legal checklists, Record of Rights (RoR), and mutation guidelines for property buyers in Odisha.',
        ]);

        $blogCat2 = BlogCategory::create([
            'name' => 'Market & Investment Trends',
            'slug' => 'market-investment-trends',
            'description' => 'Real estate growth corridors, capital appreciation trends, and farmland investment analysis in Bhubaneswar.',
        ]);

        Blog::create([
            'blog_category_id' => $blogCat1->id,
            'title' => 'Essential Legal Checklist Before Buying Land in Bhubaneswar: RoR, Mutation & Due Diligence',
            'slug' => 'essential-legal-checklist-before-buying-land-in-bhubaneswar',
            'excerpt' => 'A comprehensive guide on inspecting Record of Rights (RoR), 30-year chain deeds, and non-encumbrance certificates to ensure 100% dispute-free property purchases.',
            'content' => "Purchasing land or property is a milestone investment. However, navigating land revenue records in Odisha requires thorough understanding and vigilance.\n\n### 1. Verification of Record of Rights (RoR / Patta)\nThe RoR is the definitive legal document establishing land ownership in Odisha. Ensure the seller's name is accurately recorded in the latest computerized RoR (Bhulekh Odisha) and cross-verify the Khata number, Plot number, and Kisam (land type).\n\n### 2. Kisam Classification Audit\nEnsure the land is classified as 'Gharabari' (homestead/residential) if you intend to build immediately. Agricultural land may require formal conversion (Section 8A) before construction.\n\n### 3. 30-Year Search Report & Encumbrance Certificate (EC)\nAn Encumbrance Certificate from the Sub-Registrar's office verifies that the property has not been mortgaged to a financial institution, pledged, or entangled in legal attachments.\n\n### 4. Demarcation & Physical Boundary\nNever finalize a purchase without physical boundary demarcation. At Mais Agro House, every plot comes with surveyor-verified boundary pillars and legal certification.",
            'featured_image' => '/images/maisagro/property-3.jpeg',
            'author_name' => 'Adv. S. P. Mohanty',
            'reading_time' => '5 min read',
            'is_featured' => true,
            'is_published' => true,
            'published_at' => now()->subDays(3),
            'meta_title' => 'Legal Checklist for Buying Land in Bhubaneswar | Mais Agro House',
            'meta_description' => 'Verify RoR, 30-year chain deeds, and mutation before buying land in Bhubaneswar. Expert legal tips by Mais Agro House legal team.',
            'tags' => ['Land Legal', 'RoR Verification', 'Bhubaneswar Real Estate', 'Mutation'],
        ]);

        Blog::create([
            'blog_category_id' => $blogCat2->id,
            'title' => 'Why Farmland Investment Along Nandankanan Road is Delivering Highest Appreciation',
            'slug' => 'why-farmland-investment-along-nandankanan-road-delivering-highest-appreciation',
            'excerpt' => 'Discover how Bhubaneswar\'s northern growth corridor along Patia and Nandankanan Road has emerged as the premier hub for sustainable farmland and smart land banking.',
            'content' => "Urbanization in Bhubaneswar is rapidly moving northward along the Patia - Raghunathpur - Nandankanan corridor.\n\nDriven by major IT parks (Infocity I & II), premier educational universities (KIIT, Silicon), and upcoming multi-lane ring roads, land values in this region have consistently outpaced traditional urban pockets.\n\n### The Rise of Farm Land Investment\nInvestors are increasingly allocating capital toward fertile farmland parcels on the city outskirts. Farmlands provide a unique dual advantage: tangible, inflation-proof capital growth combined with the lifestyle benefit of having a private nature retreat or organic weekend farm.\n\nMAIS AGRO HOUSE continues to pioneer managed farmland developments with complete legal clearance, water borewells, and all-weather road connectivity.",
            'featured_image' => '/images/maisagro/about-us.webp',
            'author_name' => 'Er. Manish Kumar',
            'reading_time' => '6 min read',
            'is_featured' => true,
            'is_published' => true,
            'published_at' => now()->subDays(7),
            'meta_title' => 'Farmland Investment on Nandankanan Road | Mais Agro House',
            'meta_description' => 'Why farmland along Nandankanan Road and Patia is the fastest appreciating real estate asset in Bhubaneswar. Insights by Mais Agro House.',
            'tags' => ['Farmland Investment', 'Nandankanan Road', 'Bhubaneswar', 'Land Banking'],
        ]);

        // 11. Partners / Approvals
        $clientsData = [
            ['name' => 'Punjab National Bank (PNB)', 'logo' => null, 'website_url' => 'https://pnbindia.in'],
            ['name' => 'State Bank of India (SBI)', 'logo' => null, 'website_url' => 'https://sbi.co.in'],
            ['name' => 'HDFC Bank Home Loans', 'logo' => null, 'website_url' => 'https://hdfcbank.com'],
            ['name' => 'ICICI Bank Real Estate', 'logo' => null, 'website_url' => 'https://icicibank.com'],
            ['name' => 'RERA Odisha Compliant', 'logo' => null, 'website_url' => 'https://rera.odisha.gov.in'],
        ];

        foreach ($clientsData as $cl) {
            Client::create($cl);
        }
    }
}
