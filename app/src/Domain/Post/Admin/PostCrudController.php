<?php

declare(strict_types=1);

namespace App\Domain\Post\Admin;

use App\Domain\Post\Model\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Post')
            ->setEntityLabelInPlural('Post')
            ->setSearchFields(['title', 'subTitle', 'content', 'vignette', 'id']);
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title');
        $subTitle = TextField::new('subTitle');
        $content = TextareaField::new('content');
        $vignette = TextField::new('vignette');
        $tags = AssociationField::new('tags');
        $id = Field::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$title, $subTitle, $vignette, $id, $tags];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$title, $subTitle, $content, $vignette, $id, $tags];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$title, $subTitle, $content, $vignette, $tags];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$title, $subTitle, $content, $vignette, $tags];
        }
    }
}
