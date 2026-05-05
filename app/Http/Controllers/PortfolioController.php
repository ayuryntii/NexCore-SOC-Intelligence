<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function home()
    {
        $skills = [
            'BACKEND_CORE' => [
                ['name' => 'PHP', 'level' => 90, 'icon' => 'fab fa-php', 'color' => '#777BB4', 'years' => '4+ years'],
                ['name' => 'Laravel', 'level' => 92, 'icon' => 'fab fa-laravel', 'color' => '#FF2D20', 'years' => '3+ years'],
                ['name' => 'C# / .NET', 'level' => 70, 'icon' => 'fas fa-code', 'color' => '#178600', 'years' => '2+ years'],
                ['name' => 'Node.js', 'level' => 78, 'icon' => 'fab fa-node', 'color' => '#339933', 'years' => '2+ years'],
                ['name' => 'Python', 'level' => 78, 'icon' => 'fab fa-python', 'color' => '#3776AB', 'years' => '2+ years'],
                ['name' => 'MySQL/PostgreSQL', 'level' => 85, 'icon' => 'fas fa-database', 'color' => '#4479A1', 'years' => '3+ years'],
                ['name' => 'RESTful APIs', 'level' => 90, 'icon' => 'fas fa-network-wired', 'color' => '#4CAF50', 'years' => '3+ years'],
            ],
            'FRONTEND_INTERFACE' => [
                ['name' => 'JavaScript', 'level' => 88, 'icon' => 'fab fa-js', 'color' => '#F7DF1E', 'years' => '3+ years'],
                ['name' => 'TypeScript', 'level' => 80, 'icon' => 'fas fa-file-code', 'color' => '#3178C6', 'years' => '2+ years'],
                ['name' => 'HTML5 / CSS3', 'level' => 95, 'icon' => 'fab fa-html5', 'color' => '#E34F26', 'years' => '5+ years'],
                ['name' => 'React.js', 'level' => 85, 'icon' => 'fab fa-react', 'color' => '#61DAFB', 'years' => '2+ years'],
                ['name' => 'Tailwind CSS', 'level' => 95, 'icon' => 'fab fa-css3-alt', 'color' => '#06B6D4', 'years' => '3+ years'],
                ['name' => 'Figma (UI/UX)', 'level' => 85, 'icon' => 'fab fa-figma', 'color' => '#F24E1E', 'years' => '2+ years'],
            ],
            'SYSTEM_OPS' => [
                ['name' => 'Docker', 'level' => 75, 'icon' => 'fab fa-docker', 'color' => '#2496ED', 'years' => '1+ years'],
                ['name' => 'AWS Cloud', 'level' => 70, 'icon' => 'fab fa-aws', 'color' => '#FF9900', 'years' => '1+ years'],
                ['name' => 'Git / CI/CD', 'level' => 85, 'icon' => 'fab fa-git-alt', 'color' => '#F05032', 'years' => '3+ years'],
                ['name' => 'Postman', 'level' => 90, 'icon' => 'fas fa-envelope-open-text', 'color' => '#FF6C37', 'years' => '3+ years'],
                ['name' => 'Jira', 'level' => 75, 'icon' => 'fab fa-jira', 'color' => '#0052CC', 'years' => '2+ years'],
                ['name' => 'Trello', 'level' => 85, 'icon' => 'fab fa-trello', 'color' => '#0079BF', 'years' => '3+ years'],
            ],
        ];

        $testimonials = [
            ['name' => 'Dr. Ahmad Fauzi', 'role' => 'IT Project Director', 'text' => 'Ayu consistently delivers highly scalable and robust solutions. Her ability to architecture complex systems early in her career is commendable.', 'avatar' => 'A'],
            ['name' => 'Siti Rohmah, M.Kom', 'role' => 'Head of Technology Lab', 'text' => 'Exceptional problem-solving skills combined with a meticulous approach to clean code principles. A highly reliable engineer.', 'avatar' => 'S'],
            ['name' => 'M. Rizki Fadilah', 'role' => 'Senior Technical Lead', 'text' => 'Ayu adapts remarkably fast to new tech stacks. Her recent contributions to our cloud-native applications were outstanding.', 'avatar' => 'R'],
        ];

        return view('home', [
            'name' => 'Ayu Rianti',
            'nim' => '230511037',
            'role' => 'Software Engineer',
            'campus' => 'Universitas Muhammadiyah Cirebon',
            'semester' => 'Semester 6',
            'phone' => '+62 895 3580 72344',
            'email' => 'ayuu.riantii25@gmail.com',
            'address' => 'Cirebon, West Java, Indonesia',
            'bio' => 'As a passionate Full-Stack Software Engineer, I specialize in building scalable, performant, and secure web architectures. Continuous learning and implementing clean code principles are at the core of my development philosophy.',
            'skills' => $skills,
            'testimonials' => $testimonials,
            'experiences' => $this->getExperiences(),
            'educations' => $this->getEducations()
        ]);
    }

    private function getExperiences()
    {
        return [
            ['title' => 'Backend Software Engineer Intern', 'company' => 'Tech Solutions XYZ', 'year' => '2024 - Present', 'desc' => 'Designed and implemented high-throughput RESTful APIs using Laravel and Go. Integrated Docker for seamless CI/CD deployments.'],
            ['title' => 'Full-Stack Web Developer', 'company' => 'Freelance / Remote', 'year' => '2023 - Present', 'desc' => 'Architected customized e-commerce platforms and SaaS dashboards for various enterprise clients, achieving a 99.9% uptime.'],
            ['title' => 'IT Infrastructure Support', 'company' => 'Universitas Muhammadiyah Cirebon', 'year' => '2023 - 2024', 'desc' => 'Performed crucial server maintenance, streamlined network architectures, and resolved high-priority IT tickets efficiently.'],
        ];
    }



    public function about()
    {
        $skills = $this->getSkills(); // Helper for skills

        return view('about', [
            'name' => 'Ayu Rianti',
            'nim' => '230511037',
            'email' => 'ayuu.riantii25@gmail.com',
            'phone' => '+62 895 3580 72344',
            'address' => 'Cirebon, West Java, Indonesia',
            'campus' => 'Universitas Muhammadiyah Cirebon',
            'semester' => '6th Semester',
            'birthdate' => 'April 15, 2003',
            'bio' => 'As a passionate Full-Stack Software Engineer, I specialize in building scalable, performant, and secure web architectures. Continuous learning and implementing clean code principles are at the core of my development philosophy.',
            'experiences' => $this->getExperiences(),
            'skills' => $skills,
            'educations' => $this->getEducations()
        ]);
    }

    private function getSkills()
    {
        return [
            'BACKEND_CORE' => [
                ['name' => 'PHP', 'level' => 90, 'icon' => 'fab fa-php', 'color' => '#777BB4', 'years' => '4+ years'],
                ['name' => 'Laravel', 'level' => 92, 'icon' => 'fab fa-laravel', 'color' => '#FF2D20', 'years' => '3+ years'],
                ['name' => 'C# / .NET', 'level' => 70, 'icon' => 'fas fa-code', 'color' => '#178600', 'years' => '2+ years'],
                ['name' => 'Node.js', 'level' => 78, 'icon' => 'fab fa-node', 'color' => '#339933', 'years' => '2+ years'],
                ['name' => 'Python', 'level' => 78, 'icon' => 'fab fa-python', 'color' => '#3776AB', 'years' => '2+ years'],
                ['name' => 'MySQL/PostgreSQL', 'level' => 85, 'icon' => 'fas fa-database', 'color' => '#4479A1', 'years' => '3+ years'],
                ['name' => 'RESTful APIs', 'level' => 90, 'icon' => 'fas fa-network-wired', 'color' => '#4CAF50', 'years' => '3+ years'],
            ],
            'FRONTEND_INTERFACE' => [
                ['name' => 'JavaScript', 'level' => 88, 'icon' => 'fab fa-js', 'color' => '#F7DF1E', 'years' => '3+ years'],
                ['name' => 'TypeScript', 'level' => 80, 'icon' => 'fas fa-file-code', 'color' => '#3178C6', 'years' => '2+ years'],
                ['name' => 'HTML5 / CSS3', 'level' => 95, 'icon' => 'fab fa-html5', 'color' => '#E34F26', 'years' => '5+ years'],
                ['name' => 'React.js', 'level' => 85, 'icon' => 'fab fa-react', 'color' => '#61DAFB', 'years' => '2+ years'],
                ['name' => 'Tailwind CSS', 'level' => 95, 'icon' => 'fab fa-css3-alt', 'color' => '#06B6D4', 'years' => '3+ years'],
                ['name' => 'Figma (UI/UX)', 'level' => 85, 'icon' => 'fab fa-figma', 'color' => '#F24E1E', 'years' => '2+ years'],
            ],
            'SYSTEM_OPS' => [
                ['name' => 'Docker', 'level' => 75, 'icon' => 'fab fa-docker', 'color' => '#2496ED', 'years' => '1+ years'],
                ['name' => 'AWS Cloud', 'level' => 70, 'icon' => 'fab fa-aws', 'color' => '#FF9900', 'years' => '1+ years'],
                ['name' => 'Git / CI/CD', 'level' => 85, 'icon' => 'fab fa-git-alt', 'color' => '#F05032', 'years' => '3+ years'],
                ['name' => 'Postman', 'level' => 90, 'icon' => 'fas fa-envelope-open-text', 'color' => '#FF6C37', 'years' => '3+ years'],
                ['name' => 'Jira', 'level' => 75, 'icon' => 'fab fa-jira', 'color' => '#0052CC', 'years' => '2+ years'],
                ['name' => 'Trello', 'level' => 85, 'icon' => 'fab fa-trello', 'color' => '#0079BF', 'years' => '3+ years'],
            ],
        ];
    }


    public function education()
    {
        $educations = $this->getEducations();
        $certifications = $this->getCertifications();
        return view('education', compact('educations', 'certifications'));
    }

    private function getCertifications()
    {
        return [
            [
                'name' => 'BNSP_APPLICATION_PROGRAMMER',
                'issuer' => 'BNSP - Software Engineering (LSP P1 SMKN-1)',
                'year' => '2024',
                'icon' => 'fas fa-code'
            ],
            [
                'name' => 'BNSP_CERT_COMPETENCY',
                'issuer' => 'BNSP - Computer Programming Activities',
                'year' => '2024',
                'icon' => 'fas fa-terminal'
            ],
            [
                'name' => 'ADV_LARAVEL_ARCH',
                'issuer' => 'LARAVEL_IDN',
                'year' => '2024',
                'icon' => 'fab fa-laravel'
            ],
            [
                'name' => 'AWS_SOL_ARCH',
                'issuer' => 'AWS_ACADEMY',
                'year' => '2024',
                'icon' => 'fab fa-aws'
            ],
            [
                'name' => 'DOCKER_CONTAINER_OPS',
                'issuer' => 'MASTER_DOCKER',
                'year' => '2024',
                'icon' => 'fab fa-docker'
            ],
            [
                'name' => 'SEC_WEB_ARCHITECTURE',
                'issuer' => 'IDS_COLLEGE',
                'year' => '2025',
                'icon' => 'fas fa-shield-alt'
            ]
        ];
    }

    private function getEducations()
    {
        return [
            [
                'tahun' => '2023 - Present',
                'sekolah' => 'Universitas Muhammadiyah Cirebon',
                'jurusan' => 'Bachelor of Computer Science (Informatics)',
                'semester' => '6th Semester',
                'ipk' => '3.85',
                'deskripsi' => 'Focusing on advanced software engineering, distributed systems, machine learning, and database optimization. Leading the university tech innovation lab.',
                'icon' => 'fa-university',
                'achievements' => 'Academic Excellence Scholarship, 1st Place National Hackathon'
            ],
            [
                'tahun' => '2020 - 2023',
                'sekolah' => 'SMKN 1 Cirebon',
                'jurusan' => 'Software Engineering (RPL)',
                'ipk' => '92.5',
                'deskripsi' => 'Developed strong foundations in algorithmic problem solving, database normalization, and web application architecture.',
                'icon' => 'fa-laptop-code',
                'achievements' => '1st Winner Web Technology Skills Competition (LKS)'
            ]
        ];
    }

    public function project()
    {
        $projects = [
            [
                'nama' => 'NexCore-Auth-Shield',
                'teknologi' => 'NestJS, TypeScript, JWT, RBAC, Cyber HUD',
                'deskripsi' => 'Enterprise-grade Identity & Access Management (IAM) system built with NestJS and TypeScript. Features a professional Cyber HUD dashboard, JWT authentication, and RBAC architecture for high-security environments.',
                'tahun' => '2025',
                'link' => 'https://github.com/ayuryntii/NexCore-Auth-Shield',
                'features' => 'JWT Auth, RBAC Architecture, Cyber HUD Dashboard, NestJS Backend',
                'image_icon' => 'fa-user-shield'
            ],
            [
                'nama' => 'Flashsale-Engine',
                'teknologi' => 'Go, RabbitMQ, Redis, React, Microservices',
                'deskripsi' => 'Production-grade Flash Sale microservices built with Go, RabbitMQ & Redis. Solves Race Condition with atomic operations. Features a real-time Cyber HUD admin dashboard in React.',
                'tahun' => '2025',
                'link' => 'https://github.com/ayuryntii/Flashsale-Engine',
                'features' => 'Race Condition Solution, Atomic Operations, Real-time Dashboard, Microservices Arch',
                'image_icon' => 'fa-bolt'
            ],
            [
                'nama' => 'RabbitMQ-RaceGuard-Ticketing',
                'teknologi' => 'Node.js, RabbitMQ, React, Concurrency, Semaphore',
                'deskripsi' => 'An advanced ticket booking simulator demonstrating the implementation of RabbitMQ as a Mutual Exclusion mechanism. Built with Laravel to prevent database Race Conditions, complete with a premium Cyber HUD interface.',
                'tahun' => '2025',
                'link' => 'https://github.com/ayuryntii/RabbitMQ-RaceGuard-Ticketing',
                'features' => 'Mutual Exclusion, Semaphore Mechanism, Concurrency Control, Race Condition Prevention',
                'image_icon' => 'fa-ticket-alt'
            ],
            [
                'nama' => 'PortoAyy-SystemCore',
                'teknologi' => 'Laravel, Blade, Vanilla CSS, AOS',
                'deskripsi' => 'A futuristic "System Core" themed personal portfolio built with Laravel. Features a high-tech HUD interface, complete professional profile showcases, and an integrated automated PDF CV generator.',
                'tahun' => '2026',
                'link' => 'https://github.com/ayuryntii/PortoAyy-SystemCore',
                'features' => 'Cyber HUD Interface, Integrated CV Generator, Advanced AOS Animations, Laravel Backend Core',
                'image_icon' => 'fa-project-diagram'
            ],
            [
                'nama' => 'StudAyy-CoreSystem',
                'teknologi' => 'Vanilla JS, IndexedDB, HTML5, CSS3',
                'deskripsi' => 'Advanced personal task and learning material management system featuring a futuristic Cyber/HUD interface. Built with Vanilla JS and IndexedDB for high-performance local data persistence.',
                'tahun' => '2024',
                'link' => 'https://github.com/ayuryntii/StudAyy-CoreSystem',
                'features' => 'Futuristic Cyber/HUD UI, IndexedDB Persistence, Dynamic Task Management, Responsive Core Architecture',
                'image_icon' => 'fa-microchip'
            ],
            [
                'nama' => 'SkillPath-AI',
                'teknologi' => 'PHP, MySQL, Machine Learning Logic',
                'deskripsi' => 'Intelligent IT career recommendation engine designed to map technical competencies to industry-standard career paths using precision analysis and competency mapping.',
                'tahun' => '2024',
                'link' => 'https://github.com/ayuryntii/SkillPath-AI',
                'features' => 'AI Precision Analysis, Competency Mapping, Career Matrix, Personalized Learning Paths',
                'image_icon' => 'fa-brain'
            ],
            [
                'nama' => 'ScholarAyy-academic-guidance',
                'teknologi' => 'CodeIgniter 3, HTML/CSS, MySQL',
                'deskripsi' => 'A web-based Academic Guidance Management System designed to streamline collaboration between students, lecturers, and coordinators through digitized workflows and real-time tracking.',
                'tahun' => '2024',
                'link' => 'https://github.com/ayuryntii/ScholarAyy-academic-guidance',
                'features' => 'Digitized Workflows, Role-based Dashboards (Student, Lecturer, Coordinator), Real-time Tracking, Exportable Academic Reports',
                'image_icon' => 'fa-chalkboard-teacher'
            ],
            [
                'nama' => 'QR-Attendance-UMC',
                'teknologi' => 'PHP, MySQL, QR-Code Scanner',
                'deskripsi' => 'Sistem Absensi Mahasiswa berbasis QR Code otomatis. Dibangun menggunakan arsitektur web modern yang mendukung fungsionalitas scan langsung dan pelaporan persentase kehadiran seketika.',
                'tahun' => '2024',
                'link' => 'https://github.com/ayuryntii/QR-Attendance-UMC',
                'features' => 'Multi-role (Admin, Dosen, Mahasiswa), Real-Time QR Code Generation & Scanning, Automatic Recap Reports',
                'image_icon' => 'fa-qrcode'
            ],
            [
                'nama' => 'Finance-manager',
                'teknologi' => 'HTML, CSS, Relational Database, SQL',
                'deskripsi' => 'A specialized relational database architectural project built for comprehensive financial management. Focuses on advanced ERD designs, complex SQL joins, and robust relational integrity.',
                'tahun' => '2024',
                'link' => 'https://github.com/ayuryntii/Finance-manager',
                'features' => 'Complex SQL Relationships, Transaction Ledger System, Financial Reporting Simulation, Data Normalization',
                'image_icon' => 'fa-file-invoice-dollar'
            ],
            [
                'nama' => 'Hotel-reservation-system',
                'teknologi' => 'PHP Native, HTML, Bootstrap, MySQL',
                'deskripsi' => 'A highly scalable end-to-end hotel reservation booking engine. Developed natively in PHP to handle concurrent bookings, room unavailability validation, and customer relationship data.',
                'tahun' => '2024',
                'link' => 'https://github.com/ayuryntii/Hotel-reservation-system',
                'features' => 'Real-Time Room Availability, Concurrent Booking Safety Check, Payment Gateway Simulation, Admin Dashboard',
                'image_icon' => 'fa-concierge-bell'
            ],
            [
                'nama' => 'NexCore-Mobile-Intelligence',
                'teknologi' => 'Kotlin, Android Native, System Telemetry',
                'deskripsi' => 'Professional Android Native application built with Kotlin, featuring real-time system telemetry (RAM, Storage, Battery), asynchronous terminal logs, and a futuristic Cyber HUD interface.',
                'tahun' => '2025',
                'link' => 'https://github.com/ayuryntii/NexCore-Mobile-Intelligence',
                'features' => 'Real-time Telemetry, Async Terminal Logs, Cyber HUD Interface, Kotlin Core Architecture',
                'image_icon' => 'fa-mobile-alt'
            ],
            [
                'nama' => 'NexCore-Analytics',
                'teknologi' => 'React, TypeScript, Vite, CoinGecko API',
                'deskripsi' => 'A professional, enterprise-grade Cyber HUD analytics dashboard. Features real-time market data integration via CoinGecko API and dynamic data visualization with high-performance charts.',
                'tahun' => '2025',
                'link' => 'https://github.com/ayuryntii/NexCore-Analytics',
                'features' => 'Market Data Integration, Dynamic Visualization, Real-time Updates, Enterprise-grade Dashboard',
                'image_icon' => 'fa-chart-line'
            ],
            [
                'nama' => 'WinCalc-Desktop',
                'teknologi' => 'C#, WinForms, .NET Framework',
                'deskripsi' => 'A standard Windows Calculator application built with C# and WinForms. Features complete memory operations and a modern UI optimized for desktop use.',
                'tahun' => '2025',
                'link' => 'https://github.com/ayuryntii/WinCalc-Desktop',
                'features' => 'Memory Operations (MC, MR, M+, M-), Modern UI Design, Desktop Optimized, C# Logic',
                'image_icon' => 'fa-calculator'
            ]
        ];
        return view('project', compact('projects'));
    }
}
