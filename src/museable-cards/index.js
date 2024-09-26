const { registerBlockType } = wp.blocks;

import metadata from "./block.json";
import Edit from "./edit";

registerBlockType(metadata.name, {
  edit: Edit,
  save() {
    return null; // Server-side rendering
  },
});
