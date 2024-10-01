import { useBlockProps } from "@wordpress/block-editor";
import { useEffect, useState } from "@wordpress/element";
import apiFetch from "@wordpress/api-fetch";
import { __ } from "@wordpress/i18n";
import {
  Spinner,
  Card,
  CardBody,
  CardMedia,
  CardTitle,
} from "@wordpress/components";

const Edit = () => {
  const blockProps = useBlockProps();
  const [collections, setCollections] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    apiFetch({ path: "/custom/v1/collections/" })
      .then((response) => {
        setCollections(response);
        setLoading(false);
      })
      .catch((err) => {
        setError("Error fetching collections");
        console.error(err);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <Spinner />;
  }

  if (error) {
    return <p>{error}</p>;
  }

  console.log(__("Collection Items", "museable-components"), "Collections");

  return (
    <div {...blockProps}>
      <div>
        <h1>{__("Collection Items", "museable-components")}</h1>
      </div>
      <div className="custom-collections-block">
        {collections.map((collection) => (
          <div key={collection.id} className="collection-card">
            <img src={collection.image} alt={collection.title} />
            <div className="collection-card-body">
              <h3>{collection.title}</h3>
              <p>{collection.description}</p>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Edit;
