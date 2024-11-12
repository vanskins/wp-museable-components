import React, { useState } from "react";
import "./style.css";

const LoginForm = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  const handleLogin = () => {
    console.log("Logging in...");
  };

  const handleCancel = () => {
    setEmail("");
    setPassword("");
  };

  return (
    <div className="login-form">
      <h2>Login</h2>
      <input
        type="email"
        placeholder="Email"
        value={email}
        onChange={(e) => setEmail(e.target.value)}
        data-cy="email-input"
      />
      <input
        type="password"
        placeholder="Password"
        value={password}
        onChange={(e) => setPassword(e.target.value)}
        data-cy="password-input"
      />
      <button
        disabled={password.length === 0 || email.length === 0}
        onClick={handleLogin}
        data-cy="login-button"
      >
        Login
      </button>
      <button onClick={handleCancel} data-cy="cancel-button">
        Cancel
      </button>
    </div>
  );
};

export default LoginForm;
