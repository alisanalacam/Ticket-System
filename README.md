Ticket Sistemi
==========

## Özellikler ##

- Kullanıcı girişi ile ticket oluşturma
- Admin girişi ile ticket oluşturma, onaylama ve arama
- Ticketları kategori bazlı ekleyebilme
- Ticketlarda öncelik durumu belirleyebilme

## Kurulum

- [Composer](http://getcomposer.org) yükleyiniz
- Bağımlılıkları kurun / güncelleyin

```cli
composer install
```

- Veritabanını oluşturun (varsayılan veritabanı: ticket)

```cli
mysql -u root -p
```
ile mysql e bağlanın ve şifrenizi girin.

```cli
CREATE DATABASE ticket;
```
ile veritabanını oluşturun ve
```cli
exit
```
yazarak çıkış yapın.

```cli
mysql -u root -p -h localhost tickets < app/ticket-system.sql
```

komutu ile tabloları içeri aktarın.

- http://domain/ticket/web adresinden erişebilirsiniz

Admin Kullanıcısı:
- admin@gmail.com
- 123123a

Kullanıcı:
- alisanalacam@gmail.com
- 123213a

## Yapılacaklar

- Kategori yönetim modülü yapılacak
- Ticket yönetim modülü yapılacak
- Ticketı dosya eki ile oluşturabilme