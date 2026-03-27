import React, { useEffect, useState } from "react";
import axios from "axios";
export default function Demandes() {
  const [data, setData] = useState([]);
  const fetchDemandes = async () => {
    try {
      const res = await axios.get("http://127.0.0.1:8000/api/demandes");
      setData(res.data);
    } catch (err) {
      console.log(err);
    }
  };
  useEffect(() => {
    fetchDemandes();
    const interval = setInterval(fetchDemandes, 2000); // refresh auto
    return () => clearInterval(interval);
  }, []);
  // CSS
  const containerStyle = {padding: "40px",fontFamily: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif",background: "#f5f6fa",};
  const headerStyle = {display: "flex",alignItems: "center",marginBottom: "20px",};
  const logoStyle = { width: "50px", height: "50px", marginRight: "15px" };
  const titleStyle = { fontSize: "30px", fontWeight: "bold", color: "#2c3e50" };
  const thStyle = { textAlign: "left", padding: "12px", background: "#eef1f7" };
  const tdStyle = { padding: "12px", borderTop: "1px solid #eee" };
  const btnStyle = {padding: "6px 12px",borderRadius: "6px",border: "2px solid #ccc",cursor: "pointer",marginRight: "5px",fontWeight: "bold"};
  // Couleur selon état
  const statusClass = (etat) => {
    switch (etat) {
      case "En cours":
        return { color: "white", background: "pink", padding: "3px 8px", borderRadius:"5px" };
      case "Validé":
        return { color: "white", background: "purple", padding: "3px 8px", borderRadius:"5px" };
      case "Signé":
        return { color: "white", background: "red", padding: "3px 8px", borderRadius:"5px" };
        case "Délivré":
      return { color: "white", background: "green", padding: "3px 8px", borderRadius:"5px" };
      default:
        return {};
    }
  };
  const handleValider = async (demande) => {
    try {
      await axios.put(
        `http://127.0.0.1:8000/api/demandes/update-etat/${demande.id}`,
        { etat: "Validé" }
      );
      fetchDemandes();
    } catch (err) {
      console.log(err.response);
      console.log(err);
      alert("Impossible de valider la demande");
    }
  };
  const handleModifier = async (demande) => {
    const nouveauType = prompt("Modifier le type de document", demande.type_document);
    if (!nouveauType) return;
    try {
      await axios.put(`http://127.0.0.1:8000/api/demandes/${demande.id}`, { type_document: nouveauType });
      fetchDemandes();
    } catch (err) {
      console.log(err);
    }
  };
  const handlePDF = (demande) => {
    window.open("http://127.0.0.1:8000/api/demandes/pdf/" + demande.id);
  };
  return (
    <div style={containerStyle}>
      <h3 style={{fontSize: "32px", fontWeight: "bold", color: "#2c3e50",background: "#f5f6fa", padding: "8px 0", marginBottom: "5px", textAlign: "center"}}>
        🎓 Espace Administrateur
      </h3>
      <div style={headerStyle}>
        <img src="LOGO.jpeg" alt="Logo" style={logoStyle} />
        <h2 style={titleStyle}>Demandes</h2>
      </div>
      <table style={{ width: "100%", borderCollapse: "collapse" }}>
        <thead>
          <tr>
            <th style={thStyle}>Apogée</th>
            <th style={thStyle}>Nom</th>
            <th style={thStyle}>Document</th>
            <th style={thStyle}>Date / Heure</th>
            <th style={thStyle}>Etat</th>
            <th style={thStyle}>Action</th>
            <th style={thStyle}>Modifier</th>
            <th style={thStyle}>PDF</th>
          </tr>
        </thead>
        <tbody>
          {data.filter(item => item.etat !== "Délivré").map((item) => (
            <tr key={item.id}>
              <td style={tdStyle}>{item.etudiant?.numero_apogee}</td>
              <td style={tdStyle}>{item.etudiant?.nom} {item.etudiant?.prenom}</td>
              <td style={tdStyle}>{item.type_document}</td>
              <td style={tdStyle}>{new Date(item.created_at).toLocaleString()}</td>
              {/* Etat */}
              <td style={tdStyle}>
                <span style={statusClass(item.etat)}>
                  {item.etat}
                </span>
              </td>
              <td style={tdStyle}>
                {item.etat === "En cours" && (
                  <button style={btnStyle} onClick={() => handleValider(item)}>
                    Valider
                  </button>
                )}
              </td>
              <td style={tdStyle}>
               <button style={btnStyle} onClick={() => handleModifier(item)}>Modifier</button>
              </td>
              <td style={tdStyle}>
                {item.etat === "Validé" || item.etat === "Signé" || item.etat === "Délivré" ? (
                  <button style={btnStyle} onClick={() => handlePDF(item)}>Prêt</button>
                ) : (
                  <span style={{color:"gray"}}>Non disponible</span>
                )}
              </td> 
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}