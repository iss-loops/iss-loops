<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Modules\Article\Models\Article;
use App\Modules\Category\Models\Category;
use App\Modules\Interview\Models\Interview;
use App\Modules\Game\Models\Game;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml file';

    public function handle()
    {
        $this->info('🚀 Generating sitemap...');
        
        $sitemap = Sitemap::create();

        // ============================================
        // HOME PAGES
        // ============================================
        $this->info('📄 Adding home pages...');
        
        $sitemap->add(Url::create('/es')
            ->setLastModificationDate(Carbon::now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0));

        $sitemap->add(Url::create('/en')
            ->setLastModificationDate(Carbon::now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0));

        // ============================================
        // ARTICLES
        // ============================================
        $this->info('📰 Adding articles...');
        
        $articlesCount = 0;
        Article::published()->each(function (Article $article) use ($sitemap, &$articlesCount) {
            // Español
            $sitemap->add(Url::create("/es/articulos/{$article->slug}")
                ->setLastModificationDate($article->updated_at ?? $article->created_at ?? Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
            
            // English
            $sitemap->add(Url::create("/en/articulos/{$article->slug}")
                ->setLastModificationDate($article->updated_at ?? $article->created_at ?? Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
            
            $articlesCount++;
        });
        
        $this->info("   ✅ Added {$articlesCount} articles");

        // ============================================
        // ARTICLE INDEX PAGES
        // ============================================
        $this->info('📚 Adding article index pages...');
        
        $sitemap->add(Url::create("/es/articulos")
            ->setLastModificationDate(Carbon::now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.9));
        
        $sitemap->add(Url::create("/en/articulos")
            ->setLastModificationDate(Carbon::now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.9));

        // ============================================
        // CATEGORIES
        // ============================================
        $this->info('📂 Adding categories...');
        
        $categoriesCount = 0;
        Category::active()->each(function (Category $category) use ($sitemap, &$categoriesCount) {
            // Español
            $sitemap->add(Url::create("/es/categorias/{$category->slug}")
                ->setLastModificationDate($category->updated_at ?? $category->created_at ?? Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7));
            
            // English
            $sitemap->add(Url::create("/en/categorias/{$category->slug}")
                ->setLastModificationDate($category->updated_at ?? $category->created_at ?? Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7));
            
            $categoriesCount++;
        });
        
        $this->info("   ✅ Added {$categoriesCount} categories");

        // Categories Index
        $sitemap->add(Url::create("/es/categorias")
            ->setLastModificationDate(Carbon::now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8));
        
        $sitemap->add(Url::create("/en/categorias")
            ->setLastModificationDate(Carbon::now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8));

        // ============================================
        // INTERVIEWS
        // ============================================
        $this->info('🎬 Adding interviews...');
        
        $interviewsCount = 0;
        try {
            Interview::where('is_active', true)->each(function (Interview $interview) use ($sitemap, &$interviewsCount) {
                $sitemap->add(Url::create("/es/entrevistas/{$interview->slug}")
                    ->setLastModificationDate($interview->updated_at ?? $interview->created_at ?? Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6));
                
                $sitemap->add(Url::create("/en/entrevistas/{$interview->slug}")
                    ->setLastModificationDate($interview->updated_at ?? $interview->created_at ?? Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6));
                
                $interviewsCount++;
            });
            
            $this->info("   ✅ Added {$interviewsCount} interviews");
            
            // Interviews Index
            $sitemap->add(Url::create("/es/entrevistas")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7));
            
            $sitemap->add(Url::create("/en/entrevistas")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7));
                
        } catch (\Exception $e) {
            $this->warn("   ⚠️  Skipping interviews (table may not exist yet)");
        }

        // ============================================
        // GAMES
        // ============================================
        $this->info('🎮 Adding games...');
        
        $gamesCount = 0;
        try {
            Game::active()->each(function (Game $game) use ($sitemap, &$gamesCount) {
                $sitemap->add(Url::create("/es/games/{$game->slug}")
                    ->setLastModificationDate($game->updated_at ?? $game->created_at ?? Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.7));
                
                $sitemap->add(Url::create("/en/games/{$game->slug}")
                    ->setLastModificationDate($game->updated_at ?? $game->created_at ?? Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.7));
                
                $gamesCount++;
            });
            
            $this->info("   ✅ Added {$gamesCount} games");
            
            // Games Index
            $sitemap->add(Url::create("/es/games")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
            
            $sitemap->add(Url::create("/en/games")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
                
        } catch (\Exception $e) {
            $this->warn("   ⚠️  Skipping games (table may not exist yet)");
        }

        // ============================================
        // STATIC PAGES
        // ============================================
        $this->info('📄 Adding static pages...');
        
        $staticPages = [
            ['url' => '/nosotros', 'priority' => 0.6, 'name' => 'About Us'],
            ['url' => '/contacto', 'priority' => 0.5, 'name' => 'Contact'],
            ['url' => '/privacidad', 'priority' => 0.3, 'name' => 'Privacy'],
            ['url' => '/terminos', 'priority' => 0.3, 'name' => 'Terms'],
            ['url' => '/festival', 'priority' => 0.6, 'name' => 'Festival'],
        ];

        $staticCount = 0;
        foreach ($staticPages as $page) {
            $sitemap->add(Url::create("/es{$page['url']}")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority($page['priority']));
            
            $sitemap->add(Url::create("/en{$page['url']}")
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority($page['priority']));
            
            $staticCount += 2;
        }
        
        $this->info("   ✅ Added {$staticCount} static pages");

        // ============================================
        // SAVE SITEMAP
        // ============================================
        $this->info('💾 Saving sitemap...');
        
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->newLine();
        $this->info('✅ Sitemap generated successfully!');
        $this->info('📍 Location: public/sitemap.xml');
        
        // Count URLs
$urlCount = count($sitemap->getTags());
$this->info("📊 Total URLs: {$urlCount}");
        
        $this->newLine();
        $this->info('🌐 You can view it at: ' . url('/sitemap.xml'));
        
        return Command::SUCCESS;
    }
}