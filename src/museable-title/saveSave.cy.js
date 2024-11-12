import React from "react";
import Save from "./save";

describe("<Save />", () => {
  it("renders", () => {
    // see: https://on.cypress.io/mounting-react
    cy.mount(<Save />);
  });
});
