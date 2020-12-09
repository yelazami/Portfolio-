<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200324203303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE place (id UUID NOT NULL, name VARCHAR(255) NOT NULL, coordinates VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN place.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE course (id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, begin_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, course_type VARCHAR(255) NOT NULL, curriculum VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_169E6FB9BF396750 ON course (id)');
        $this->addSql('COMMENT ON COLUMN course.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN course.begin_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN course.end_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE courses_places (course_id UUID NOT NULL, place_id UUID NOT NULL, PRIMARY KEY(course_id, place_id))');
        $this->addSql('CREATE INDEX IDX_A186F923591CC992 ON courses_places (course_id)');
        $this->addSql('CREATE INDEX IDX_A186F923DA6A219 ON courses_places (place_id)');
        $this->addSql('COMMENT ON COLUMN courses_places.course_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN courses_places.place_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE experience (id UUID NOT NULL, type_id UUID DEFAULT NULL, key_points_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, level VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_590C103C54C8C93 ON experience (type_id)');
        $this->addSql('CREATE INDEX IDX_590C103A2AFCA55 ON experience (key_points_id)');
        $this->addSql('COMMENT ON COLUMN experience.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN experience.type_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN experience.key_points_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE experiences_projects (experience_id UUID NOT NULL, project_id UUID NOT NULL, PRIMARY KEY(experience_id, project_id))');
        $this->addSql('CREATE INDEX IDX_539D83D946E90E27 ON experiences_projects (experience_id)');
        $this->addSql('CREATE INDEX IDX_539D83D9166D1F9C ON experiences_projects (project_id)');
        $this->addSql('COMMENT ON COLUMN experiences_projects.experience_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN experiences_projects.project_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE experience_type (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN experience_type.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE key_point (id UUID NOT NULL, text TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN key_point.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE tag (id UUID NOT NULL, name VARCHAR(255) NOT NULL, icon VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN tag.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE post (id UUID NOT NULL, title VARCHAR(255) NOT NULL, sub_title VARCHAR(255) DEFAULT NULL, content TEXT NOT NULL, vignette VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN post.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE posts_tags (post_id UUID NOT NULL, tag_id UUID NOT NULL, PRIMARY KEY(post_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_D5ECAD9F4B89032C ON posts_tags (post_id)');
        $this->addSql('CREATE INDEX IDX_D5ECAD9FBAD26311 ON posts_tags (tag_id)');
        $this->addSql('COMMENT ON COLUMN posts_tags.post_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN posts_tags.tag_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE project (id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN project.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE projects_experiences (project_id UUID NOT NULL, experience_id UUID NOT NULL, PRIMARY KEY(project_id, experience_id))');
        $this->addSql('CREATE INDEX IDX_DFDCAAE3166D1F9C ON projects_experiences (project_id)');
        $this->addSql('CREATE INDEX IDX_DFDCAAE346E90E27 ON projects_experiences (experience_id)');
        $this->addSql('COMMENT ON COLUMN projects_experiences.project_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN projects_experiences.experience_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE projects_courses (project_id UUID NOT NULL, course_id UUID NOT NULL, PRIMARY KEY(project_id, course_id))');
        $this->addSql('CREATE INDEX IDX_8466415D166D1F9C ON projects_courses (project_id)');
        $this->addSql('CREATE INDEX IDX_8466415D591CC992 ON projects_courses (course_id)');
        $this->addSql('COMMENT ON COLUMN projects_courses.project_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN projects_courses.course_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE resource_type (id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN resource_type.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE resource (id UUID NOT NULL, type_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BC91F416C54C8C93 ON resource (type_id)');
        $this->addSql('COMMENT ON COLUMN resource.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN resource.type_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE courses_places ADD CONSTRAINT FK_A186F923591CC992 FOREIGN KEY (course_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE courses_places ADD CONSTRAINT FK_A186F923DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103C54C8C93 FOREIGN KEY (type_id) REFERENCES experience_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103A2AFCA55 FOREIGN KEY (key_points_id) REFERENCES key_point (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE experiences_projects ADD CONSTRAINT FK_539D83D946E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE experiences_projects ADD CONSTRAINT FK_539D83D9166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE posts_tags ADD CONSTRAINT FK_D5ECAD9F4B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE posts_tags ADD CONSTRAINT FK_D5ECAD9FBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE projects_experiences ADD CONSTRAINT FK_DFDCAAE3166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE projects_experiences ADD CONSTRAINT FK_DFDCAAE346E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE projects_courses ADD CONSTRAINT FK_8466415D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE projects_courses ADD CONSTRAINT FK_8466415D591CC992 FOREIGN KEY (course_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F416C54C8C93 FOREIGN KEY (type_id) REFERENCES resource_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE courses_places DROP CONSTRAINT FK_A186F923DA6A219');
        $this->addSql('ALTER TABLE courses_places DROP CONSTRAINT FK_A186F923591CC992');
        $this->addSql('ALTER TABLE projects_courses DROP CONSTRAINT FK_8466415D591CC992');
        $this->addSql('ALTER TABLE experiences_projects DROP CONSTRAINT FK_539D83D946E90E27');
        $this->addSql('ALTER TABLE projects_experiences DROP CONSTRAINT FK_DFDCAAE346E90E27');
        $this->addSql('ALTER TABLE experience DROP CONSTRAINT FK_590C103C54C8C93');
        $this->addSql('ALTER TABLE experience DROP CONSTRAINT FK_590C103A2AFCA55');
        $this->addSql('ALTER TABLE posts_tags DROP CONSTRAINT FK_D5ECAD9FBAD26311');
        $this->addSql('ALTER TABLE posts_tags DROP CONSTRAINT FK_D5ECAD9F4B89032C');
        $this->addSql('ALTER TABLE experiences_projects DROP CONSTRAINT FK_539D83D9166D1F9C');
        $this->addSql('ALTER TABLE projects_experiences DROP CONSTRAINT FK_DFDCAAE3166D1F9C');
        $this->addSql('ALTER TABLE projects_courses DROP CONSTRAINT FK_8466415D166D1F9C');
        $this->addSql('ALTER TABLE resource DROP CONSTRAINT FK_BC91F416C54C8C93');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE courses_places');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE experiences_projects');
        $this->addSql('DROP TABLE experience_type');
        $this->addSql('DROP TABLE key_point');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE posts_tags');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE projects_experiences');
        $this->addSql('DROP TABLE projects_courses');
        $this->addSql('DROP TABLE resource_type');
        $this->addSql('DROP TABLE resource');
    }
}
