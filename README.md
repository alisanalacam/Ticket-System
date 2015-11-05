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
- Veritabanı şemasını oluşturun (varsayılan veritabanı username/password: root/123)

- http://domain/ticket/web adresinden erişebilirsiniz

## Yapılacaklar

- Twig render motoru eklenecek
- ZF1 Form component eklenecek
- Doctrine ORM servisi eklenecek
- Kullanıcı ve admin için giriş ekranları yapılacak
- Tema tasarımı yapılacak
- Kategori yönetim modülü yapılacak
- Ticket yönetim modülü yapılacak