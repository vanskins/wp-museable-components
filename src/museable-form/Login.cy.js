import React from "react";
import LoginForm from "./Login";

describe("LoginForm Component", () => {
  beforeEach(() => {
    cy.mount(<LoginForm />);
  });

  it("1. Email should be valid", () => {
    cy.get("[data-cy=email-input]").type("user@example.com");
    cy.get("[data-cy=email-input]").should("have.value", "user@example.com");
  });

  it("2. Email is not a valid email", () => {
    cy.get("[data-cy=email-input]").type("invalid-email");
    cy.get("[data-cy=email-input]").should("have.value", "invalid-email");
  });

  it("3. Email input is empty", () => {
    cy.get("[data-cy=email-input]").should("have.value", "");
  });

  it("4. Password is empty", () => {
    cy.get("[data-cy=password-input]").should("have.value", "");
  });

  it("5. Cancel button is clickable", () => {
    cy.get("[data-cy=email-input]").type("test@example.com");
    cy.get("[data-cy=password-input]").type("password123");
    cy.get("[data-cy=cancel-button]").click();
    cy.get("[data-cy=email-input]").should("have.value", "");
    cy.get("[data-cy=password-input]").should("have.value", "");
  });

  it("6. Login button is clickable", () => {
    cy.get("[data-cy=email-input]").type("user@example.com");
    cy.get("[data-cy=password-input]").type("password123");
    cy.get("[data-cy=login-button]").click();
    cy.log("Login button clicked");
  });

  it("7. Login button is disabled if email and password are empty", () => {
    cy.get("[data-cy=email-input]").clear();
    cy.get("[data-cy=password-input]").clear();
    cy.get("[data-cy=login-button]").should("be.disabled");
  });

  it("8. Login button is enabled if email and password have values", () => {
    cy.get("[data-cy=email-input]").type("user@example.com");
    cy.get("[data-cy=password-input]").type("password123");
    cy.get("[data-cy=login-button]").should("not.be.disabled");
  });
});
