import "./home.css";
import { Link } from "react-router-dom";
function Home() {
  return (
    <div className="container">
        <header className="header">
            <img src="LOGO.jpeg" alt="logo" className="logo"/>
            <h2>GESTION GUICHET UNIVERSITAIRE</h2>
        </header>
        <h1 className="title">Plateforme de Gestion du Guichet</h1>
        <div className="cards">
            <div className="card">
                <img src="ETU.jpeg" alt="student"/>
                <h3>Espace Étudiant</h3>
                <p>Déposer une demande de document universitaire</p>
                <Link to="/etudiant">
                    <button>Accéder</button>
                </Link>
            </div>
            <div className="card">
                <img src="ADD.jpeg" alt="admin"/>
                <h3>Espace Administrateur</h3>
                <p>Gérer les demandes des étudiants</p>
                <Link to="/admin">
                    <button>Connexion</button>
                </Link>
            </div>
        </div>
        <footer>Université – 2026 Tous droits réservés</footer>
    </div>
  );
}
export default Home;