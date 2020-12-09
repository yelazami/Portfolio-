<?php

declare(strict_types=1);

namespace App\Application\Admin;

use App\Domain\Course\Model\Course;
use App\Domain\Course\Model\Place;
use App\Domain\Experience\Model\Experience;
use App\Domain\Experience\Model\KeyPoint;
use App\Domain\Experience\Model\Type as ExperienceType;
use App\Domain\Post\Model\Post;
use App\Domain\Post\Model\Tag;
use App\Domain\Project\Model\Project;
use App\Domain\Resource\Model\Resource;
use App\Domain\Resource\Model\Type as ResourceType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio')
            ->setTranslationDomain('admin');
    }

    public function configureCrud(): Crud
    {
        return Crud::new();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Course', 'fas fa-folder-open', Course::class);
        yield MenuItem::linkToCrud('Place', 'fas fa-folder-open', Place::class);
        yield MenuItem::linkToCrud('Experience', 'fas fa-folder-open', Experience::class);
        yield MenuItem::linkToCrud('KeyPoint', 'fas fa-folder-open', KeyPoint::class);
        yield MenuItem::linkToCrud('ExperienceType', 'fas fa-folder-open', ExperienceType::class);
        yield MenuItem::linkToCrud('Post', 'fas fa-folder-open', Post::class);
        yield MenuItem::linkToCrud('Tag', 'fas fa-folder-open', Tag::class);
        yield MenuItem::linkToCrud('Project', 'fas fa-folder-open', Project::class);
        yield MenuItem::linkToCrud('Resource', 'fas fa-folder-open', Resource::class);
        yield MenuItem::linkToCrud('ResourceType', 'fas fa-folder-open', ResourceType::class);
    }
}
