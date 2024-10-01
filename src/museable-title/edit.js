import { __ } from "@wordpress/i18n";
import {
  useBlockProps,
  RichText,
  BlockControls,
  InspectorControls,
  PanelColorSettings,
} from "@wordpress/block-editor";
import { ToolbarGroup, ToolbarButton } from "@wordpress/components";

const Edit = ({ attributes, setAttributes }) => {
  const { content, level, textColor, backgroundColor } = attributes;
  const tagName = `h${level}`;

  const onChangeContent = (newContent) => {
    setAttributes({ content: newContent });
  };

  const onChangeLevel = (newLevel) => {
    setAttributes({ level: newLevel });
  };

  const onChangeTextColor = (newTextColor) => {
    setAttributes({ textColor: newTextColor });
  };

  const onChangeBackgroundColor = (newBackgroundColor) => {
    setAttributes({ backgroundColor: newBackgroundColor });
  };

  const COLORS = [
    { name: "Red", color: "#e74c3c" },
    { name: "Navy Blue", color: "#2c3e50" },
    { name: "Blue", color: "#2980b9" },
  ];

  return (
    <div
      {...useBlockProps({
        style: {
          color: textColor,
          backgroundColor: backgroundColor, // Ensure this is set correctly
        },
      })}
    >
      <BlockControls>
        <ToolbarGroup>
          {[1, 2, 3, 4, 5, 6].map((headingLevel) => (
            <ToolbarButton
              key={headingLevel}
              label={__("Heading " + headingLevel, "museable-components")}
              isPressed={level === headingLevel}
              onClick={() => onChangeLevel(headingLevel)}
            >
              {`H${headingLevel}`}
            </ToolbarButton>
          ))}
        </ToolbarGroup>
      </BlockControls>

      <InspectorControls>
        <PanelColorSettings
          title={__("Color Settings", "museable-components")}
          colorSettings={[
            {
              value: textColor,
              onChange: onChangeTextColor,
              label: __("Text Color", "museable-components"),
              colors: COLORS,
            },
            {
              value: backgroundColor,
              onChange: onChangeBackgroundColor,
              label: __("Background Color", "museable-components"),
              colors: COLORS,
            },
          ]}
        />
      </InspectorControls>

      <RichText
        tagName={tagName}
        value={content}
        onChange={onChangeContent}
        placeholder={__("Add heading...", "museable-components")}
        allowedFormats={["core/bold", "core/italic"]}
        style={{
          color: textColor,
          backgroundColor: backgroundColor,
        }}
      />
    </div>
  );
};

export default Edit;
