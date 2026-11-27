<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Book;
use App\Entity\Category;
use DateTimeImmutable;

class BookTest extends TestCase
{   
    // Methode
    // Test Valide
    public function testGetTitreReturnGoodValue(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $expect = "test";
        //setter l'attribut
        $testBook->setTitle($expect);
        //2 Act
        $actual  = $testBook->getTitle();
        //3 Assert
        self::assertSame($expect, $actual );
    }

    public function testGetResumReturnGoodValue(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $expect = "test";
        //setter l'attribut
        $testBook->setResume($expect);
        //2 Act
        $actual  = $testBook->getResume();
        //3 Assert
        self::assertSame($expect, $actual );
    }

    public function testGetAuthorReturnGoodValue(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $expect = "test";
        //setter l'attribut
        $testBook->setAuthor($expect);
        //2 Act
        $actual  = $testBook->getAuthor();
        //3 Assert
        self::assertSame($expect, $actual );
    }

    public function testGetPublishAtReturnGoodValue(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $expect = new DateTimeImmutable();
        //setter l'attribut
        $testBook->setPublishAt($expect);
        //2 Act
        $actual  = $testBook->getPublishAt();
        //3 Assert
        self::assertSame($expect, $actual );
    }



    //Test qui échoue volontairement
    public function testGetTitleReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $actual  = "test";
        $expect = "test2";
        //setter l'attribut
        $testBook->setTitle($actual);
        //2 Act
        $actual=$testBook->getTitle();
        //3 Assert
        self::assertNotSame($expect , $actual );
    }

    public function testGetResumReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $actual  = "test";
        $expect = "test2";
        //setter l'attribut
        $testBook->setResume($actual);
        //2 Act
        $actual=$testBook->getResume();
        //3 Assert
        self::assertNotSame($expect , $actual );
    }

    public function testGetAuthorReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $actual  = "test";
        $expect = "test2";
        //setter l'attribut
        $testBook->setAuthor($actual);
        //2 Act
        $actual=$testBook->getAuthor();
        //3 Assert
        self::assertNotSame($expect , $actual );
    }

    public function testGePublishAtReturnInvalid(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //stocker le résultat attendu
        $actual  = new DateTimeImmutable();
        $expect = new DateTimeImmutable("1982-09-21");
        //setter l'attribut
        $testBook->setPublishAt($actual);
        //2 Act
        $actual=$testBook->getPublishAt();
        //3 Assert
        self::assertNotSame($expect , $actual );
    }

    // Erreur de format
    public function testTitreTypeErrorException(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //Expect
        $this->expectException(\TypeError::class);
        //2 Act
        $testBook->setTitle(["tests"]);
    }

    public function testResumTypeErrorException(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
         //créer un objet vide
        $testBook = new Book();
        //Expect
        $this->expectException(\TypeError::class);
        //2 Act
        $testBook->setResume(["tests"]);
    }

    public function testAuthorTypeErrorException(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //Expect
        $this->expectException(\TypeError::class);
        //2 Act
        $testBook->setAuthor(["tests"]);
    }

    public function testPublishAtTypeErrorException(): void
    {
        //1 Arrange
        //créer un objet vide
        $testBook = new Book();
        //Expect
        $this->expectException(\TypeError::class);
        //2 Act
        $testBook->setPublishAt(["tests"]);
    }

    //  Vérifier l’ajout et le retrait de catégories avec des objets en mémoire.
    public function testAddCategoryStoresTheCategoryInstance(): void
    {
        // Arrange
        $book = new Book();
        $category = new Category();
        $expected = [$category];

        // Act
        $book->addCategory($category);

        // Assert
        $actual = $book->getCategories()->toArray();
        self::assertSame($expected, $actual);
    }


    public function testAddCategoryStoresTheCategoryInstanceCount(): void
    {
        // Arrange
        $book = new Book();
        $category = new Category();

        // Act
        $book->addCategory($category);
        $book->addCategory($category);

        // Assert
        $actual = $book->getCategories()->toArray();
        self::assertCount(1, $actual);
    }

    public function testCategoryContainDoublon(){
        // Arrange
        $book = new Book();
        $category1 = new Category();
        $category2 = new Category();

        // Act
        $book->addCategory($category1);
        self::assertCount(1, $book->getCategories());
        $book->addCategory($category2);
        self::assertCount(2, $book->getCategories());
        $book->removeCategory($category1);

        // Assert
        // self::assertCount(2, $book->getCategories());
        self::assertCount(1, $book->getCategories());
        self::assertFalse($book->getCategories()->contains($category1));
        self::assertTrue($book->getCategories()->contains($category2));
        
    }

}