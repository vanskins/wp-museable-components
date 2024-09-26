import { useBlockProps, RichText } from "@wordpress/block-editor";

const Save = ({ attributes }) => {
  const { content, level, textColor, backgroundColor } = attributes;
  const tagName = `h${level}`; // Ensure this matches the heading level

  return (
    <RichText.Content
      {...useBlockProps.save({
        style: {
          color: textColor,
          backgroundColor: backgroundColor || "transparent", // Use 'transparent' if no color is set
        },
      })}
      tagName={tagName}
      value={content ? content : ""} // Ensure content is always valid
    />
  );
};

export default Save;
