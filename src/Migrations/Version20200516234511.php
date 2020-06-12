<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200516234511 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE portfolio_pictures (portfolio_id INTEGER NOT NULL, pictures_id INTEGER NOT NULL, PRIMARY KEY(portfolio_id, pictures_id))');
        $this->addSql('CREATE INDEX IDX_F3F67558B96B5643 ON portfolio_pictures (portfolio_id)');
        $this->addSql('CREATE INDEX IDX_F3F67558BC415685 ON portfolio_pictures (pictures_id)');
        $this->addSql('DROP TABLE portfolio_portfolio');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pictures AS SELECT id, name, created_at, updated_at FROM pictures');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('CREATE TABLE pictures (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO pictures (id, name, created_at, updated_at) SELECT id, name, created_at, updated_at FROM __temp__pictures');
        $this->addSql('DROP TABLE __temp__pictures');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE portfolio_portfolio (portfolio_source INTEGER NOT NULL, portfolio_target INTEGER NOT NULL, PRIMARY KEY(portfolio_source, portfolio_target))');
        $this->addSql('CREATE INDEX IDX_5745814E59619246 ON portfolio_portfolio (portfolio_source)');
        $this->addSql('CREATE INDEX IDX_5745814E4084C2C9 ON portfolio_portfolio (portfolio_target)');
        $this->addSql('DROP TABLE portfolio_pictures');
        $this->addSql('CREATE TEMPORARY TABLE __temp__pictures AS SELECT id, name, created_at, updated_at FROM pictures');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('CREATE TABLE pictures (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO pictures (id, name, created_at, updated_at) SELECT id, name, created_at, updated_at FROM __temp__pictures');
        $this->addSql('DROP TABLE __temp__pictures');
    }
}
