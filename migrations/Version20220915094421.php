<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220915094421 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fournisseur DROP FOREIGN KEY FK_369ECA3226D29801');
        $this->addSql('DROP INDEX UNIQ_369ECA3226D29801 ON fournisseur');
        $this->addSql('ALTER TABLE fournisseur DROP userfournisseur_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fournisseur ADD userfournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseur ADD CONSTRAINT FK_369ECA3226D29801 FOREIGN KEY (userfournisseur_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_369ECA3226D29801 ON fournisseur (userfournisseur_id)');
    }
}
