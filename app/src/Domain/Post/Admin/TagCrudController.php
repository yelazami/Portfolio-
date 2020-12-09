<?php

declare(strict_types=1);

namespace App\Domain\Post\Admin;

use App\Domain\Post\Model\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Tag')
            ->setEntityLabelInPlural('Tag')
            ->setSearchFields(['name', 'icon', 'id']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $icon = TextField::new('icon');
        $id = Field::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $icon, $id];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$name, $icon, $id];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $icon];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $icon];
        }
    }
}
