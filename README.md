## Museable components

## **Version**: 0.0.1

### Description

**My Custom Plugin** This plugin is a simple plugin for museable components.

---

### Installation

1. Upload the plugin folder to the `/wp-content/plugins/` directory or upload the ZIP file via **Plugins > Add New > Upload Plugin**.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. After activating the plugin it will populate sample data for collection table.

---

### Usage

1. Create your own page from Admin dashboard.
2. After creating, using the gutenberg editor you can explor the default blocks like heading, images etc. Since you already installed the plugin you can use the museable components that are available.
3. In the search bar type keyword Museable collections try to insert it in the editor.
4. You can see card components with populated data, mocking the Collection cards of Museable web.

### Blocks

1. Museable Collections - This block is a data fetching block which shows the collections from the database.
2. Museable Title - This block is just a custom Heading.

## Development Mode

1. During development, use the command `npm run start` to enable real-time output and preview your changes as you code.
2. Once development is complete, run `npm run build` to generate the production-ready build files.

### Zip

1. In the same project directory, execute the command `npm run plugin-zip`. Ensure that the build is prepared for production by running `npm run build` first.
2. The resulting zip file will contain the same content as the initial .php file, ready for deployment.
