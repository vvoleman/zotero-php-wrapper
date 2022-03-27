Zotero PHP Wrapper
=============

PHP wrapper for citation software Zotero

Features
------------

Object-oriented approach. Since I don't know the full scale of API, I can painlessly add new endpoints and stuffs

Installation
------------

`composer require vvoleman/zotero-php-wrapper`


Usage
-----

- [Connect to Zotero](#connect-to-zotero)
	- [Get API key](#get-api-key)
	- [Create instance](#create-instance)

## Connect to Zotero

To use Zotero's API, you need to generate API key.

### Get API key

Log into your Zotero account and access [Feeds/API](https://www.zotero.org/settings/keys) part of profile settings and
click **Create new private key**.

Next, you can specify what permissions will this API key have. Save your API key, since you won't be able to retrieve it
after you leave this page.

### Create instance

Hop into your code and create some whooshing wrapper instance.

```php
$api = new ZoteroApi("YOUR_API_KEY",new KeysSource("YOUR_API_KEY"));
$api->run();
$data = $api->getBody();
```

Let's explain it a bit.
`ZoteroApi` instance requires API key for authentication and source.

Source is main branch from which we want to retrieve our data. So far, there are:

- `UsersSource`/`GroupSource`
	- All your precious collections and items are linked to a user or to group. Working with both them is a same.
	- After you create your `UsersSource`/`GroupSource` instance, you set endpoints to them
	  with `ZoteroApi::setEndpoint()`, which takes as a parameter instance of AbstractEndpoint

    ```php
      $api = new ZoteroApi($_ENV["API_KEY"], new UsersSource("YOUR_USER_ID"));
      $api->setEndpoint(
          (new Collections("COLLECTION_ID"))
                ->setEndpoint(new Items(AbstractEndpoint::ALL))
      );
    ```

	- AbstractEndpoint can chain another AbstractEndpoint - think of it like you can add `/items` to `/collections/ID`.
	  However, there are limits to chaining. You can't add `/items` to `/collections` - you have to specify specific
	  collection.
	- So, here are possible chainings (not all, but you get the idea):
		- `Collections("ID")` -> `Items(<All options>)`
			- `Collections("ID")` -> `Items("ID")` -> `Tags("ID")`
			- `Collections("ID")` -> `Items("ID")` -> `Tags(AbstractEndpoint::ALL)`
	- AbstractEndpoint takes as a constructor parameter a string value that specifies what you want to search
		- `AbstractEndpoint::ALL` - All results
		- `AbstractEndpoint::TOP` - Top-level results only
		- `AbstractEndpoint::TRASH` - Results in trash
		- `"ID"` - Specific ID of Endpoint
