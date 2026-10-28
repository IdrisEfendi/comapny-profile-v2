# Database Setup

## Fresh Installation

Create the database first, then run the complete schema:

```bash
mysql -u root -p db_cp < database/schema.sql
```

The schema includes `site_settings`, `company_profile`, `products`, `management`,
`news`, `admin_users`, and `contact_messages`.

News supports optional `image_path` and `pdf_path` values. Website branding is
stored in `site_settings` under the `logo_path` key.

## Existing Installation

The application can add the news attachment columns manually if needed:

```sql
ALTER TABLE news ADD COLUMN image_path varchar(255) DEFAULT NULL AFTER content;
ALTER TABLE news ADD COLUMN pdf_path varchar(255) DEFAULT NULL AFTER image_path;
```

The `logo_path` value does not require a schema change because settings use the
key-value table `site_settings`.
