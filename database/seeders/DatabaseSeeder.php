<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create/Update Admin
        $admin = User::updateOrCreate(
            ['email' => 'ayuriantii25@gmail.com'],
            [
                'name' => 'Ayu Riantii',
                'password' => Hash::make('ayu123'),
                'role' => 'admin',
            ]
        );

        // 2. Define Categories
        $categories = [
            'Cyber Security', 'Artificial Intelligence', 'Blockchain', 'Hardware', 
            'Software Development', 'Global Threats', 'Zero-Day Exploits', 
            'AI Security', 'Cyber Warfare', 'Data Breaches'
        ];

        $catModels = [];
        foreach ($categories as $catName) {
            $catModels[$catName] = Category::updateOrCreate(
                ['slug' => Str::slug($catName)],
                ['name' => $catName]
            );
        }

        // 3. Define Image Sources (Unsplash IDs for cyber/tech)
        $imageIds = [
            '1550751827-4bd374c3f58b', '1563986768609-322da13575f3', '1526374965328-7f61d4dc18c5', 
            '1510511459019-5dda7724fd87', '1451187580459-43490279c0fa', '1558494949-ef010cbdcc48', 
            '1518770660439-4636190af475', '1550741164-c0f251485567', '1544197150-b99a580bb7a8', 
            '1519389950473-47ba0277781c', '1504384308090-c894fdcc538d', '1515879218367-8466d910aaa4',
            '1550751827-4bd374c3f58b', '1517694712202-14dd9538aa97', '1555066931-4365d14bab8c',
            '1523961131990-5ea7c61b2107', '1498050108023-c5249f4df085', '1516321318423-f06f85e504b3',
            '1526628953301-3e589a6a1274', '1531297484001-80022131f5a1'
        ];

        // 4. Generate 10 posts per category
        foreach ($catModels as $catName => $cat) {
            for ($i = 1; $i <= 10; $i++) {
                $title = $this->generateProfessionalTitle($catName, $i);
                $content = $this->generateLongProfessionalContent($catName, $title);
                $imageId = $imageIds[array_rand($imageIds)] . '?sig=' . rand(1, 10000);
                $imageUrl = "https://images.unsplash.com/photo-{$imageId}&auto=format&fit=crop&w=1200&q=80";

                Post::updateOrCreate(
                    ['slug' => Str::slug($title)],
                    [
                        'title' => $title,
                        'content' => $content,
                        'image' => $imageUrl, // Storing full URL
                        'category_id' => $cat->id,
                        'user_id' => $admin->id,
                        'status' => 'publish',
                        'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
                    ]
                );
            }
        }
    }

    private function generateProfessionalTitle($category, $index)
    {
        $prefixes = ['Analyzing', 'The Impact of', 'Future Trends in', 'Deciphering', 'Advanced Strategies for', 'Global Perspectives on', 'The Evolution of', 'Security Protocols in', 'Critical Analysis of', 'Understanding'];
        $suffixes = ['v' . rand(1, 9) . '.' . rand(0, 9), 'Systems', 'Infrastructures', 'Networks', 'Protocols', 'Architectures', 'Ecologies', 'Paradigms', 'Frameworks', 'Methodologies'];
        
        return $prefixes[array_rand($prefixes)] . ' ' . $category . ' ' . $suffixes[array_rand($suffixes)] . ' (ID-' . rand(1000, 9999) . ')';
    }

    private function generateLongProfessionalContent($category, $title)
    {
        $intro = "The realm of {$category} is undergoing a rapid transformation, driven by unprecedented technological shifts and emerging threat vectors. In this comprehensive intelligence report, we delve into the intricate layers of '{$title}', exploring its implications for global digital stability. \n\n";
        
        $body1 = "Current data streams indicate a significant uptick in sophisticated activities within the {$category} sector. Experts suggest that the traditional defensive perimeters are no longer sufficient to mitigate the risks associated with modern computational warfare. By implementing advanced heuristic analysis and real-time monitoring, organizations can achieve a higher degree of resilience. However, the human element remains a critical vulnerability in even the most secure environments. \n\n";
        
        $body2 = "Furthermore, the integration of distributed ledger technologies and edge computing has introduced a new dimension of complexity. While these advancements offer enhanced scalability and performance, they also expand the attack surface for malicious actors. It is imperative to establish a zero-trust architecture that prioritizes identity verification and data encryption at every node. Failure to do so could result in catastrophic system-wide failures with far-reaching economic consequences. \n\n";
        
        $body3 = "Analyzing the socio-technical aspects of this evolution reveals a deeper need for international collaboration. Cyber boundaries are increasingly blurred, and a unified response to global threats is the only viable path forward. This involves not only technological synchronization but also a robust legal and ethical framework that governs the use of autonomous digital entities. As we move closer to a fully interconnected global network, the stakes for {$category} have never been higher. \n\n";
        
        $conclusion = "In conclusion, '{$title}' represents a pivotal moment in the ongoing narrative of technological progress. It challenges our existing paradigms and demands a proactive, intelligence-driven approach to security. By remaining vigilant and embracing innovation, we can navigate the shadows of the digital age and build a secure foundation for the future of humanity's information ecosystem. \n\n[REPORT_END // AUTHORIZED_ACCESS_ONLY]";

        return $intro . $body1 . $body2 . $body3 . $conclusion;
    }
}
