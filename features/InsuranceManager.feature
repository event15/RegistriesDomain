#language: pl

Potrzeba biznesowa: Zarządzanie ubezpieczeniami
  W celu zarządzania ubezpieczeniami
  Jako pracownik firmy
  Chcę:
  - dodać nowe ubezpieczenie do samochodu
  - dodać do ubezpieczenia plik ze skanem
  - usunąć ubezpieczenie
  - usunąć plik z ubezpieczenia

  Założenia:
    Kiedy mam następujące dane samochodów, chcę je dodać do repozytorium:
      | id           | responsiblePerson | model | brand | registrationNumber | productionDate | warrantyPeriod | city   | department |
      | CAR-GDY-0001 | 1                 | 126p  | Fiat  | GD 12345           | 2000           | 2015-12-30     | Gdynia | DRO        |
      | CAR-GDY-0002 | 2                 | 126p  | Fiat  | GD 12345           | 2010           | 2015-12-30     | Gdynia | DRO        |
      | CAR-KRA-0001 | 4                 | 126p  | Fiat  | GD 12345           | 2011           | 2015-12-30     | Gdynia | DRO        |
      | CAR-KRA-0002 | 5                 | 126p  | Fiat  | GD 12345           | 2008           | 2015-12-30     | Gdynia | DRO        |