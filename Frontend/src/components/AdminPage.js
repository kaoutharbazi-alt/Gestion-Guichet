import { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../api/api"; 
import "./admin.css";
export default function AdminPage() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const navigate = useNavigate();
    const handleLogin = async (e) => {
        e.preventDefault();
        try {
            const res = await api.post("/admin/login", { email, password });
            alert(`Bienvenue administrateur ${res.data.admin.name}`);
            navigate("/dashboard");
        } catch (err) {
            alert("Email ou mot de passe incorrect");
        }
    };
    return (
        <div style={{ maxWidth: 400, margin: "50px auto", textAlign: "center" }} className="admin-container">
            <h2>Connexion Administrateur</h2>
            <form onSubmit={handleLogin}>
                <div>
                    <label>Email:</label>
                    <input type="email" value={email} required onChange={(e) => setEmail(e.target.value)}/>
                </div>
                <div style={{ marginTop: 10 }}>
                    <label>Password:</label>
                    <input type="password" value={password} required onChange={(e) => setPassword(e.target.value)}/>
                </div>
                <button type="submit" style={{ marginTop: 20 }}>Connexion</button>
            </form>
        </div>
    );
}