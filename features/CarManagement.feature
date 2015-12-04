#language: pl

Potrzeba biznesowa: Zarządzanie samochodami
  W celu zarządzania rejestrem samochodów
  Jako pracownik firmy
  Chcę:
  + dodać nowy samochód
  + usunąć wybrany samochód
  + pobrać wszystkie istniejące samochody z repozytorium
  + otrzymać informację o nieistniejącym samochodzie w czasie pobierania samochodu o ID który nie istnieje
  + zmodyfikować wybrany przez siebie samochód
  - dodać do samochodu przegląd
  - dodać do samochodu drugi przegląd (data może być wcześniejsza lub późniejsza niż data przeglądu poprzedniego)
  - dodać do samochodu plik ze skanem dowodu rejestracyjnego
  - dodać do samochodu drugi plik ze skanem dowodu rejestracyjnego
  - usunąć z samochodu plik ze skanem dowodu rejestracyjnego


  Założenia:
    Kiedy mam następujące dane samochodów, chcę je dodać do repozytorium:
      | id | responsiblePerson | model | brand | registrationNumber | productionDate | warrantyPeriod | city   | department |
      | 1  | PERSON-123        | 126p  | Fiat  | GD 12345           | 2000           | 2015-12-30     | Gdynia | DRO        |
      | 2  | PERSON-123        | 126p  | Fiat  | GD 12345           | 2010           | 2015-12-30     | Gdynia | DRO        |
      | 3  | PERSON-123        | 126p  | Fiat  | GD 12345           | 2011           | 2015-12-30     | Gdynia | DRO        |
      | 4  | PERSON-123        | 126p  | Fiat  | GD 12345           | 2008           | 2015-12-30     | Gdynia | DRO        |

  Scenariusz: Pobieranie wybranego samochodu z repozytorium
    Mając w repozytorium dodane samochody
    Wtedy chciałbym pobrać samochód "CAR-GDY-0001"
    Oraz chciałbym pobrać samochód "CAR-GDY-0002"
    Oraz chciałbym pobrać samochód "CAR-KRA-0001"
    Oraz chciałbym pobrać samochód "CAR-KRA-0002"
    Oraz chciałbym aby nie było możliwe pobranie samochodu "CAR-125"

  Scenariusz: Usuwanie wybranego samochodu z repozytorium
    Mając w repozytorium dodane samochody
    Wtedy chciałbym usunąć samochód "CAR-GDY-0001"
    Oraz chciałbym aby nie było możliwe pobranie samochodu "CAR-GDY-0001"

  Scenariusz: Pobieranie wszystkich samochodów z repozytorium
    Mając w repozytorium dodane samochody
    Wtedy chciałbym pobrać listę wszystkich samochodów do tablicy

  Szablon scenariusza: Modyfikowanie wybranego samochodu
    Mając w repozytorium dodane samochody
    Wtedy chciałbym zmienić osobę odpowiedzialną <responsible_person> w samochodzie <id>
    Oraz chciałbym zmienić miasto <city> w którym się znajduje samochód <id>
    Oraz w samochodzie <id> chciałbym zmienić dział <department> odpowiedzialny

    Przykłady:
      | id | responsible_person | city   | department |
      | 1  | PERSON-001         | Kraków | TI         |
      | 1  | PERSON-002         |        |            |
      | 1  |                    | Gdynia |            |
      | 1  |                    |        | IT         |
      | 1  | PERSON-004         | Kraków |            |
      | 1  |                    | Gdynia | HR         |
      | 1  | PERSON-006         |        |   DRO      |

  Szablon scenariusza: Dodanie do samochodu informacji o nowym przeglądzie
    Mając w repozytorium dodane samochody
    Wtedy chciałbym dodać informację o przeglądzie z numerem <id>, w którym data ostatniego to <last_inspection>, a data następnego to <upcoming_inspection>

    Przykłady:
      | id           | last_inspection | upcoming_inspection |
      | CAR-INS-0001 |                 | 2015-12-30          |
      | CAR-INS-0002 | 2015-12-30      | 2016-12-30          |
      | CAR-INS-0003 | 2016-12-30      | 2017-12-30          |
      | CAR-INS-0004 | 2017-12-15      | 2018-12-30          |
      | CAR-INS-0004 | 2018-12-31      | 2019-12-30          |


  Szablon scenariusza: Dodanie do samochodu nowego pliku dowodu rejestracyjnego
    Mając w repozytorium dodane samochody
    Wtedy przygotuję <id> nowego pliku dowodu rejestracyjnego
    Oraz podam ścieżkę <source> do pliku, który wyślę na serwer
    Oraz podam tytuł <title> i opis <description>

    Przykłady:
      | id           | source                | title                    | description    |
      | CAR-DOC-0001 | /resources/documents/ | Dowód rejestracyjny 2014 | Zapłacono 98zł |
      | CAR-DOC-0002 | /resources/documents/ |                          |                |

