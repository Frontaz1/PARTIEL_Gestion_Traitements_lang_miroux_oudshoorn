<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129131832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE indication ADD patient_id INT DEFAULT NULL, ADD traitement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE indication ADD CONSTRAINT FK_D15065D76B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE indication ADD CONSTRAINT FK_D15065D7DDA344B6 FOREIGN KEY (traitement_id) REFERENCES traitement (id)');
        $this->addSql('CREATE INDEX IDX_D15065D76B899279 ON indication (patient_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D15065D7DDA344B6 ON indication (traitement_id)');
        $this->addSql('ALTER TABLE medicament ADD indication_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A9D662842 FOREIGN KEY (indication_id) REFERENCES indication (id)');
        $this->addSql('CREATE INDEX IDX_9A9C723A9D662842 ON medicament (indication_id)');
        $this->addSql('ALTER TABLE traitement ADD consultation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE traitement ADD CONSTRAINT FK_2A356D2762FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2A356D2762FF6CDF ON traitement (consultation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE indication DROP FOREIGN KEY FK_D15065D76B899279');
        $this->addSql('ALTER TABLE indication DROP FOREIGN KEY FK_D15065D7DDA344B6');
        $this->addSql('DROP INDEX IDX_D15065D76B899279 ON indication');
        $this->addSql('DROP INDEX UNIQ_D15065D7DDA344B6 ON indication');
        $this->addSql('ALTER TABLE indication DROP patient_id, DROP traitement_id');
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A9D662842');
        $this->addSql('DROP INDEX IDX_9A9C723A9D662842 ON medicament');
        $this->addSql('ALTER TABLE medicament DROP indication_id');
        $this->addSql('ALTER TABLE traitement DROP FOREIGN KEY FK_2A356D2762FF6CDF');
        $this->addSql('DROP INDEX UNIQ_2A356D2762FF6CDF ON traitement');
        $this->addSql('ALTER TABLE traitement DROP consultation_id');
    }
}
