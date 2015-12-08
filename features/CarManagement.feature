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
  + dodać do samochodu przegląd
  + dodać do samochodu drugi przegląd (data może być wcześniejsza lub późniejsza niż data przeglądu poprzedniego)
  + dodać do samochodu plik ze skanem dowodu rejestracyjnego
  + dodać do samochodu drugi plik ze skanem dowodu rejestracyjnego
  + usunąć z samochodu plik ze skanem dowodu rejestracyjnego


  Założenia:
    Kiedy mam następujące dane samochodów, chcę je dodać do repozytorium:
      | id | responsiblePerson | model | brand | registrationNumber | productionDate | warrantyPeriod | city   | department |
      | 1  | 1                 | 126p  | Fiat  | GD 12345           | 2000           | 2015-12-30     | Gdynia | DRO        |
      | 2  | 2                 | 126p  | Fiat  | GD 12345           | 2010           | 2015-12-30     | Gdynia | DRO        |
      | 3  | 4                 | 126p  | Fiat  | GD 12345           | 2011           | 2015-12-30     | Gdynia | DRO        |
      | 4  | 3                 | 126p  | Fiat  | GD 12345           | 2008           | 2015-12-30     | Gdynia | DRO        |

  Scenariusz: Pobieranie wybranego samochodu z repozytorium
    Mając w repozytorium dodane samochody
    Wtedy chciałbym pobrać samochód "1"
    Oraz chciałbym pobrać samochód "2"
    Oraz chciałbym pobrać samochód "3"
    Oraz chciałbym pobrać samochód "4"
    Oraz chciałbym aby nie było możliwe pobranie samochodu "5"

  Scenariusz: Usuwanie wybranego samochodu z repozytorium
    Mając w repozytorium dodane samochody
    Wtedy chciałbym usunąć samochód "4"
    Oraz chciałbym aby nie było możliwe pobranie samochodu "4"

  Scenariusz: Pobieranie wszystkich samochodów z repozytorium
    Mając w repozytorium dodane samochody
    Wtedy chciałbym pobrać listę wszystkich samochodów do tablicy

  Szablon scenariusza: Modyfikowanie wybranego samochodu
    Mając w repozytorium dodane samochody
    Wtedy chciałbym zmienić osobę odpowiedzialną na "<responsiblePerson>" w samochodzie "<id>"
    Oraz chciałbym zmienić miasto na "<city>" w którym się znajduje samochód "<id>"
    Oraz w samochodzie "<id>" chciałbym zmienić dział odpowiedzialny na "<department>"

    Przykłady:
      | id | responsiblePerson | city   | department |
      | 1  | 1                 | Kraków | TI         |
      | 1  | 2                 | Kraków | TI         |
      | 1  | 2                 | Gdynia | TI         |
      | 1  | 2                 | Gdynia | BIR        |
      | 1  | 4                 | Kraków | BIR        |
      | 1  | 4                 | Gdynia | HR         |
      | 1  | 6                 | Gdynia | DRO        |

  Szablon scenariusza: Dodanie do samochodu informacji o nowym przeglądzie
    Mając w repozytorium dodane samochody
    Wtedy chciałbym w samochodzie <carId> dodać informację o przeglądzie z numerem "<id>", w którym data ostatniego to "<lastInspection>", a data następnego to "<upcomingInspection>"
    Oraz chciałbym aby nie było możliwe dodanie dwóch przeglądów o takim samym "<id>" do jednego samochodu "<carId>"

    Przykłady:
      | carId | id | lastInspection | upcomingInspection |
      | 1     | 1  | now            | 2015-12-30         |
      | 1     | 2  | 2015-12-30     | 2016-12-30         |
      | 1     | 3  | 2016-12-30     | 2017-12-30         |
      | 1     | 4  | 2017-12-15     | 2018-12-30         |
      | 1     | 4  | 2018-12-31     | 2019-12-30         |
      | 1     | 5  | 2020-12-31     | 2019-12-30         |


  Scenariusz: Dodanie do samochodu nowego pliku dowodu rejestracyjnego
    Mając w repozytorium dodane samochody
    Wtedy przygotuję nowy plik dowodu rejestracyjnego o następujących parametrach:
      | id | carId | source                | title                    | description    |
      | 1  | 1     | /resources/documents/ | Dowód rejestracyjny 2014 | Zapłacono 98zł |
      | 2  | 1     | /resources/documents/ | null                     | null           |

  Scenariusz: Usunięcie wybranego pliku dowodu rejestracyjnego
    Mając w repozytorium dodane samochody
    Oraz mając dodane pliki z dowodem rejestracyjnym do samochodu
    Wtedy chciałbym usunąć plik "1" ze skanem dowodu rejestracyjnego
    Oraz chciałbym aby nie było możliwe usunięcie nieistniejącego pliku "5"


