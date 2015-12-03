#language: pl

Potrzeba biznesowa: Zarządzanie samochodami
  W celu zarządzania rejestrem samochodów
  Jako pracownik firmy
  Chcę:
  - dodać nowy samochód
  - usunąć wybrany samochód
  - pobrać wszystkie istniejące samochody z repozytorium
  - otrzymać informację o nieistniejącym samochodzie w czasie pobierania samochodu o ID który nie istnieje


  Założenia:
    Kiedy mam następujące dane samochodów, chcę je dodać do repozytorium:
      | id           | responsiblePerson | model | brand | registrationNumber | productionDate | warrantyPeriod | city   | department |
      | CAR-GDY-0001 | PERSON-123        | 126p  | Fiat  | GD 12345           | 2000           | 2015-12-30     | Gdynia | DRO        |
      | CAR-GDY-0002 | PERSON-123        | 126p  | Fiat  | GD 12345           | 2010           | 2015-12-30     | Gdynia | DRO        |
      | CAR-KRA-0001 | PERSON-123        | 126p  | Fiat  | GD 12345           | 2011           | 2015-12-30     | Gdynia | DRO        |
      | CAR-KRA-0002 | PERSON-123        | 126p  | Fiat  | GD 12345           | 2008           | 2015-12-30     | Gdynia | DRO        |

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