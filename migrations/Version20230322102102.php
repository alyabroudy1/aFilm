<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230322102102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, year VARCHAR(55) DEFAULT NULL, rated VARCHAR(55) DEFAULT NULL, released DATE DEFAULT NULL, runtime VARCHAR(55) DEFAULT NULL, genre VARCHAR(255) DEFAULT NULL, director VARCHAR(255) DEFAULT NULL, writer VARCHAR(255) DEFAULT NULL, actors VARCHAR(255) DEFAULT NULL, plot LONGTEXT DEFAULT NULL, language VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, awards VARCHAR(255) DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL, metascore SMALLINT DEFAULT NULL, imdb_rating DOUBLE PRECISION DEFAULT NULL, imdb_votes INT DEFAULT NULL, imdb_id VARCHAR(255) DEFAULT NULL, type VARCHAR(55) DEFAULT NULL, dvd DATE DEFAULT NULL, box_office VARCHAR(255) DEFAULT NULL, production VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rental (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, movie_id INT DEFAULT NULL, status SMALLINT DEFAULT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, rental_price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_1619C27DA76ED395 (user_id), INDEX IDX_1619C27D8F93B6FC (movie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rental ADD CONSTRAINT FK_1619C27D8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental DROP FOREIGN KEY FK_1619C27DA76ED395');
        $this->addSql('ALTER TABLE rental DROP FOREIGN KEY FK_1619C27D8F93B6FC');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE rental');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
