<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology', 'Programming', 'Web Development', 'Mobile Development', 'Artificial Intelligence',
            'Machine Learning', 'Data Science', 'Cybersecurity', 'Cloud Computing', 'DevOps',
            'Blockchain', 'Cryptocurrency', 'Gaming', 'E-Sports', 'Hardware Reviews',
            'Software Reviews', 'Gadgets', 'Smartphones', 'Laptops', 'Operating Systems',
            'Linux', 'Windows', 'MacOS', 'Frontend Development', 'Backend Development',
            'Full Stack Development', 'API Development', 'Database Management', 'Big Data',
            'Data Analytics', 'Internet of Things (IoT)', 'AR/VR', 'Embedded Systems',
            'Quantum Computing', 'Programming Languages', 'JavaScript', 'Python', 'Java',
            'C++', 'C#', 'Ruby', 'PHP', 'Kotlin', 'Swift', 'Go', 'Rust',
            'Software Engineering', 'Agile Methodologies', 'Scrum', 'Kanban',
            'Version Control', 'Git', 'GitHub', 'GitLab', 'Software Testing',
            'Test Automation', 'Unit Testing', 'Integration Testing', 'Performance Testing',
            'DevSecOps', 'Microservices', 'Serverless Architecture', 'Edge Computing', 'Code Optimization',
            'Programming Patterns', 'Clean Code', 'Refactoring', 'Design Patterns',
            'Algorithms', 'Data Structures', 'Competitive Programming', 'Open Source',
            'Code Reviews', 'Web Performance', 'Progressive Web Apps (PWA)', 'Web3',
            'Mobile App Optimization', 'UI Frameworks', 'Vue.js', 'React', 'Angular',
            'Svelte', 'Next.js', 'Nuxt.js', 'Django', 'Laravel', 'Spring Framework',
            'ASP.NET', 'Node.js', 'Express.js', 'NestJS', 'GraphQL',
            'REST APIs', 'Docker', 'Kubernetes', 'CI/CD', 'SaaS Development',
            'Cross-Platform Development', 'Software Localization', 'Software Licensing',
            'Artificial Neural Networks', 'Deep Learning', 'NLP (Natural Language Processing)',
            'Computer Vision', 'Recommender Systems', 'Ethical AI', 'Tech Ethics',
            'Tech Startups', 'Tech News', 'Product Development', 'UI/UX Principles',
            'Web Security', 'Penetration Testing', 'Security Best Practices',
            'Responsive Design', 'Cross-Browser Compatibility', 'Open Source Contributions',
            'Performance Engineering', 'Tech Tools', 'Integrated Development Environments (IDEs)',
            'Code Editors', 'Developer Productivity', 'Code Refactoring Tools', 'Tech Communities', 'Photography', 'Video Editing', 'Graphic Design',
            'UI/UX Design', 'Startups', 'Entrepreneurship', 'Business', 'Marketing',
            'Digital Marketing', 'Social Media', 'SEO', 'Content Marketing', 'E-Commerce',
            'Dropshipping', 'Freelancing', 'Career Development', 'Personal Finance', 'Investing',
            'Stock Market', 'Real Estate', 'Cryptocurrency Trading', 'Health', 'Fitness',
            'Nutrition', 'Mental Health', 'Yoga', 'Lifestyle', 'Travel',
            'Food', 'Recipes', 'Restaurants', 'Fashion', 'Beauty',
            'Makeup', 'Haircare', 'Skincare', 'Parenting', 'Education',
            'Online Learning', 'Books', 'Movies', 'TV Shows', 'Music',
            'Sports', 'Football', 'Basketball', 'Tennis', 'Motorsports',
            'Hobbies', 'DIY', 'Crafts', 'Gardening', 'Photography Tips',
            'Science', 'Space', 'Astronomy', 'Physics', 'Chemistry',
            'Biology', 'History', 'Politics', 'News', 'Culture',
            'Philosophy', 'Religion', 'Relationships', 'Self-Help', 'Motivation',
            'Productivity', 'Technology Trends', 'Programming Tutorials', 'Career Advice', 'Startups Tips',
            'Finance Tips', 'Travel Guides', 'Food Blogs', 'Personal Stories', 'Case Studies'
        ];

        foreach ($categories as $category) {
            $categoryData[] = [
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Category::insert($categoryData);

    }
}
