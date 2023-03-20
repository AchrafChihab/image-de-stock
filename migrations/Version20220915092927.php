<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220915092927 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article_client');
        $this->addSql('ALTER TABLE client ADD fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_C7440455670C757F ON client (fournisseur_id)');
        $this->addSql('ALTER TABLE magasin ADD fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE magasin ADD CONSTRAINT FK_54AF5F27670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_54AF5F27670C757F ON magasin (fournisseur_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D7A6C841');
        $this->addSql('DROP INDEX IDX_8D93D649D7A6C841 ON user');
        $this->addSql('ALTER TABLE user CHANGE userclient_id fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649670C757F ON user (fournisseur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_client (article_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_AD8393D57294869C (article_id), INDEX IDX_AD8393D519EB6921 (client_id), PRIMARY KEY(article_id, client_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article_client ADD CONSTRAINT FK_AD8393D57294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455670C757F');
        $this->addSql('DROP INDEX IDX_C7440455670C757F ON client');
        $this->addSql('ALTER TABLE client DROP fournisseur_id');
        $this->addSql('ALTER TABLE magasin DROP FOREIGN KEY FK_54AF5F27670C757F');
        $this->addSql('DROP INDEX IDX_54AF5F27670C757F ON magasin');
        $this->addSql('ALTER TABLE magasin DROP fournisseur_id');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649670C757F');
        $this->addSql('DROP INDEX IDX_8D93D649670C757F ON `user`');
        $this->addSql('ALTER TABLE `user` CHANGE fournisseur_id userclient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649D7A6C841 FOREIGN KEY (userclient_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D7A6C841 ON `user` (userclient_id)');
    }
}
