<?php

declare(strict_types=1);

namespace App\Domain\Experience\Admin;

use App\Domain\Experience\Model\KeyPoint;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class KeyPointCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return KeyPoint::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('KeyPoint')
            ->setEntityLabelInPlural('KeyPoint')
            ->setSearchFields(['text', 'id']);
    }

    public function configureFields(string $pageName): iterable
    {
        $text = TextareaField::new('text');
        $id = Field::new('id', 'ID');
        $experiences = AssociationField::new('experiences');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $experiences];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$text, $id, $experiences];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$text];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$text];
        }
    }
}
