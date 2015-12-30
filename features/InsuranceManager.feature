#language: pl

Potrzeba biznesowa: Zarządzanie ubezpieczeniami
  W celu zarządzania ubezpieczeniami
  Jako pracownik firmy
  Chcę:
  + dodać nowe ubezpieczenie do samochodu
  + dodać do ubezpieczenia plik ze skanem
  - usunąć ubezpieczenie
  - usunąć plik z ubezpieczenia

  Założenia:
    Kiedy mam następujące dane samochodów, chcę je dodać do repozytorium:
      | id | responsiblePerson | model | brand | registrationNumber | productionDate | warrantyPeriod | city   | department |
      | 1  | 1                 | 126p  | Fiat  | GD 12345           | 2000           | 2015-12-30     | Gdynia | DRO        |
    Wtedy chciałbym do samochodu "1" dodać ubezpieczenie o następujących danych:
      | id | type | dateFrom   | dateTo     | insurerId |
      | 1  | AC   | 2014-01-01 | 2015-01-01 | 1         |

  Scenariusz: Dodanie ubezpieczenia bez pliku
    Mając w repozytorium dodane samochody
    Wtedy chciałbym do samochodu "1" dodać ubezpieczenie o następujących danych:
      | id | type | dateFrom   | dateTo     | insurerId |
      | 2  | AC   | 2015-01-02 | 2016-01-02 | 1         |
      | 3  | OC   | 2014-01-01 | 2015-01-01 | 2         |
      | 4  | ASS  | 2014-01-01 | 2015-01-01 | 3         |
      | 5  | NWW  | 2014-01-01 | 2015-01-01 | 4         |
    Oraz nie można dodać ubezpieczenia do samochodu "1", gdy różnica między dateFrom i dateTo jest inna niż jeden rok:
      | id | type | dateFrom   | dateTo     | insurerId |
      | 5  | AC   | 2013-01-01 | 2014-01-31 | 1         |
      | 6  | AC   | 2013-01-01 | 2013-12-31 | 2         |
    Oraz chciałbym aby dla samochodu "1" istniały ubezpieczenia:
      | id |
      | 2  |
      | 3  |
      | 4  |
      | 5  |
    Oraz chciałbym aby dla samochodu "1" nie istniały ubezpieczenia o "<id>":
      | id |
      | 5  |
      | 6  |


  Scenariusz: Dodanie drugiego i kolejnego ubezpieczenia bez pliku
    Mając w repozytorium dodane samochody
    Wtedy chciałbym do samochodu "1" dodać ubezpieczenie o następujących danych:
      | id | type | dateFrom   | dateTo     | insurerId |
      | 7  | AC   | 2016-01-03 | 2017-01-03 | 1         |
    #
    # Przypadki negatywne:
    #
    Oraz nie można dodać kolejnego ubezpieczenia do samochodu "1", którego data rozpoczęcia będzie wcześniej niż data końca poprzedniego:
      | id | type | dateFrom   | dateTo     | insurerId |
      | 8  | AC   | 2015-01-02 | 2016-01-02 | 1         |
      | 8  | AC   | 2015-01-01 | 2016-01-01 | 2         |
    Oraz nie można dodać kolejnego ubezpieczenia do samochodu "1", którego data rozpoczęcia będzie później niż data końca poprzedniego:
      | id | type | dateFrom   | dateTo     | insurerId |
      | 8  | AC   | 2015-01-04 | 2016-01-03 | 1         |
      | 8  | AC   | 2015-01-04 | 2016-01-03 | 2         |
    Oraz chciałbym aby w samochodzie "1" było ubezpieczenie o id "7"
    Oraz chciałbym aby w samochodzie "1" nie było ubezpieczenia o id "3"

  Scenariusz: Dodanie pliku do istniejącego ubezpieczenia
    Mając w repozytorium dodane ubezpieczenia
    Wtedy chciałbym do istniejącego ubezpieczenia dodać plik:
      | carId | fileId | insuranceId | source                                     | title                    | description    |
      | 1     | 1      | 1           | /resources/documents/insurances/ac2014.pdf | Dowód rejestracyjny 2014 | Zapłacono 98zł |
    Oraz chciałbym dodać do istniejącego ubezpieczenia kolejny plik:
      | carId | fileId | insuranceId | source                                              | title                    | description    |
      | 1     | 2      | 1           | /resources/documents/insurances/ac2014-poprawka.pdf | Dowód rejestracyjny 2014 | Zapłacono 98zł |
    #
    # Przypadki negatywne:
    #
    Oraz chciałbym aby nie było możliwe dodanie pliku do nieistniejącego ubezpieczenia:
      | carId | fileId | insuranceId | source                                     | title                    | description    |
      | 1     | 3      | 666         | /resources/documents/insurances/ac2014.pdf | Dowód rejestracyjny 2014 | Zapłacono 98zł |
      | 1     | 1      | 1           | /resources/documents/insurances/ac2014.pdf | Dowód rejestracyjny 2014 | Zapłacono 98zł |
    Oraz chciałbym aby nie było możliwe dodanie kolejnego pliku o id "1"
    Oraz chciałbym aby nie była możliwa podmiana istniejącego pliku "/resources/documents/insurances/ac2014.pdf"

  Scenariusz: Usunięcie pliku z istniejącego ubezpieczenia
    Mając w repozytorium dodane ubezpieczenia
    Wtedy chciałbym usunąć plik "2"
    Oraz chciałbym aby nie było możliwe pobranie pliku "2"
    Oraz chciałbym aby nie było możliwe usunięcie pliku "666"