# Block Specific Styles

This directory contains block-specific styles. And file you create in this directory will be automatically included in the editor and on the front end when the block is used. The file should be named after the blocks name and be placed in a directory named after the blocks namespace.

So if you have some styles you want to only load when the `core/paragraph` block is used, you would create a file at `wp-content/themes/10up-theme/assets/css/blocks/core/paragraph.css`.

Similarly if you work with a block from a plugin that has a namespace of `acme`, you would create a file at `wp-content/themes/10up-theme/assets/css/blocks/acme/block-name.css`.

# ACF Blocks Directory

This directory is designated for ACF (Advanced Custom Fields) block styles and assets. Note that the actual ACF block files should be placed outside of this CSS directory structure.

## Naming Convention

When creating ACF blocks, ensure proper naming conventions are followed for consistency and maintainability across the theme.

## File Organization

- Block-specific CSS files should be placed in this directory
- Actual ACF block PHP files should be located outside of the assets/css directory
- Follow the established naming patterns for easy identification and maintenance
- ACF Blocks will be put outside of the directory.
