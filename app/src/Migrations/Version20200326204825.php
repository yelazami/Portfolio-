<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200326204825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE experiences_key_points (experience_id UUID NOT NULL, key_point_id UUID NOT NULL, PRIMARY KEY(experience_id, key_point_id))');
        $this->addSql('CREATE INDEX IDX_90CB576C46E90E27 ON experiences_key_points (experience_id)');
        $this->addSql('CREATE INDEX IDX_90CB576C12B052D ON experiences_key_points (key_point_id)');
        $this->addSql('COMMENT ON COLUMN experiences_key_points.experience_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN experiences_key_points.key_point_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE key_point_experience (key_point_id UUID NOT NULL, experience_id UUID NOT NULL, PRIMARY KEY(key_point_id, experience_id))');
        $this->addSql('CREATE INDEX IDX_CF050D6B12B052D ON key_point_experience (key_point_id)');
        $this->addSql('CREATE INDEX IDX_CF050D6B46E90E27 ON key_point_experience (experience_id)');
        $this->addSql('COMMENT ON COLUMN key_point_experience.key_point_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN key_point_experience.experience_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE project_experience (project_id UUID NOT NULL, experience_id UUID NOT NULL, PRIMARY KEY(project_id, experience_id))');
        $this->addSql('CREATE INDEX IDX_1D36BA31166D1F9C ON project_experience (project_id)');
        $this->addSql('CREATE INDEX IDX_1D36BA3146E90E27 ON project_experience (experience_id)');
        $this->addSql('COMMENT ON COLUMN project_experience.project_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN project_experience.experience_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE experiences_key_points ADD CONSTRAINT FK_90CB576C46E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE experiences_key_points ADD CONSTRAINT FK_90CB576C12B052D FOREIGN KEY (key_point_id) REFERENCES key_point (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE key_point_experience ADD CONSTRAINT FK_CF050D6B12B052D FOREIGN KEY (key_point_id) REFERENCES key_point (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE key_point_experience ADD CONSTRAINT FK_CF050D6B46E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_experience ADD CONSTRAINT FK_1D36BA31166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_experience ADD CONSTRAINT FK_1D36BA3146E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE projects_experiences');
        $this->addSql('ALTER TABLE experience DROP CONSTRAINT fk_590c103a2afca55');
        $this->addSql('DROP INDEX idx_590c103a2afca55');
        $this->addSql('ALTER TABLE experience DROP key_points_id');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE projects_experiences (project_id UUID NOT NULL, experience_id UUID NOT NULL, PRIMARY KEY(project_id, experience_id))');
        $this->addSql('CREATE INDEX idx_dfdcaae3166d1f9c ON projects_experiences (project_id)');
        $this->addSql('CREATE INDEX idx_dfdcaae346e90e27 ON projects_experiences (experience_id)');
        $this->addSql('COMMENT ON COLUMN projects_experiences.project_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN projects_experiences.experience_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE projects_experiences ADD CONSTRAINT fk_dfdcaae3166d1f9c FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE projects_experiences ADD CONSTRAINT fk_dfdcaae346e90e27 FOREIGN KEY (experience_id) REFERENCES experience (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE experiences_key_points');
        $this->addSql('DROP TABLE key_point_experience');
        $this->addSql('DROP TABLE project_experience');
        $this->addSql('ALTER TABLE experience ADD key_points_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN experience.key_points_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT fk_590c103a2afca55 FOREIGN KEY (key_points_id) REFERENCES key_point (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_590c103a2afca55 ON experience (key_points_id)');
    }
}
