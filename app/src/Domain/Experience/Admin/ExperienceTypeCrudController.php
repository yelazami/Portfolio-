<?php

declare(strict_types=1);

namespace App\Domain\Experience\Admin;

use App\Domain\Experience\Model\Type as ExperienceType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExperienceTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ExperienceType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('ExperienceType')
            ->setEntityLabelInPlural('ExperienceTypes')
            ->setSearchFields(['text', 'id']);
    }
}
