<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202072119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE effet_snd (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE effet_snd_medicament (effet_snd_id INT NOT NULL, medicament_id INT NOT NULL, INDEX IDX_99AE196FC23FFDD1 (effet_snd_id), INDEX IDX_99AE196FAB0D61F7 (medicament_id), PRIMARY KEY(effet_snd_id, medicament_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE effet_snd_medicament ADD CONSTRAINT FK_99AE196FC23FFDD1 FOREIGN KEY (effet_snd_id) REFERENCES effet_snd (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE effet_snd_medicament ADD CONSTRAINT FK_99AE196FAB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE effet_snd_medicament DROP FOREIGN KEY FK_99AE196FC23FFDD1');
        $this->addSql('ALTER TABLE effet_snd_medicament DROP FOREIGN KEY FK_99AE196FAB0D61F7');
        $this->addSql('DROP TABLE effet_snd');
        $this->addSql('DROP TABLE effet_snd_medicament');
    }
}
