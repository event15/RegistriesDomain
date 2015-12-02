#language: pl

Potrzeba biznesowa: Dodawanie nowego samochodu
  Jako pracownik chcę dodać nowy samochód

  Scenariusz: Dodanie samochodu ze wszystkimi wymaganymi informacjami
    Kiedy dodam nowy samochód:
      | id      | responsiblePerson | model | brand | registrationNumber | productionDate | warrantyPeriod | city   | department |
      | CAR-123 | PERSON-123        | 126p  | Fiat  | GD 12345           | 2000           | 2015-12-30     | Gdynia | DRO        |
      | CAR-123 | PERSON-123        | 126p  | Fiat  | GD 12345           | 2000           | 2015-12-30     | Gdynia | DRO        |
      | CAR-123 | PERSON-123        | 126p  | Fiat  | GD 12345           | 2000           | 2015-12-30     | Gdynia | DRO        |
      | CAR-123 | PERSON-123        | 126p  | Fiat  | GD 12345           | 2000           | 2015-12-30     | Gdynia | DRO        |

    Wtedy chciałbym pobrać samochód "CAR-123"