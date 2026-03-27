import { useState } from "react";
import axios from "axios";
function Etudiant() {
  const [etudiant,setEtudiant] = useState(null);
  const [numero_apogee, setApogee] = useState("");
  const [type_document, setDocument] = useState("");
  const [demandes, setDemandes] = useState([]);
  const envoyerDemande = async (e) => {
    e.preventDefault();
    if(!numero_apogee || !type_document){
      alert("Remplir les champs");
      return;
    }
    try {
      const res = await axios.post(
        "http://127.0.0.1:8000/api/demandes",
        {
          numero_apogee: etudiant.numero_apogee,
          type_document: type_document
        }
      );
      alert("Demande envoyée");
      setDemandes([...demandes,res.data.data]);
    } catch (error) {
      console.log(error);
      console.log("RESPONSE:", error.response);
      alert(error.response?.data?.message || "Erreur envoi demande");
    }
  };
  const chargerDemandes = async(numero)=>{
    const res = await axios.get(`/etudiant/demandes/${numero}`);
    setDemandes(res.data);
  }
  // récupérer demandes
  const voirDemandes = async (numero) => {
    if(!numero){
      alert("Entrer numéro apogée");
      return;
    }
    try{
      const res = await axios.get(
        "http://127.0.0.1:8000/api/etudiant/demandes/" + numero_apogee
      );
      setDemandes(res.data);
    }catch(error){
      console.log(error);
      alert("Erreur récupération demandes");
    }
  };
  const chercherEtudiant = async () => {
    try {
      const res = await axios.get(
        "http://127.0.0.1:8000/api/etudiants/" + numero_apogee
      );
      console.log(res.data);
      setEtudiant(res.data);
    } catch (error) {
      console.log(error);
      alert("Etudiant introuvable");
    }
  };
  const imprimer = async(id)=>{
    try{
      await axios.put("http://127.0.0.1:8000/api/demandes/delivrer/" + id);
      const res = await axios.get(
        "http://127.0.0.1:8000/api/etudiant/demandes/" + numero_apogee
      );
      voirDemandes(numero_apogee);
      setTimeout(()=>{
        window.open("http://127.0.0.1:8000/api/demandes/pdf/" + id);
      },500);
    }catch(error){
      console.log(error);
    }
  }
  const handleLogout = () => {
    const confirmLogout = window.confirm("Voulez-vous vraiment quitter ?");
    if (confirmLogout) {
      window.location.href = "/";
    }
  };
  return (
    <div style={styles.page}>
      <div style={styles.container}>
        <h1 style={styles.title}>🎓 Espace Étudiant</h1>
        {/* formulaire demande */}
        <div style={styles.card}>
          <h2>Demander un document</h2>
          <input type="text" placeholder="Numéro Apogée" value={numero_apogee} onChange={(e)=>setApogee(e.target.value)} onKeyDown={chercherEtudiant} style={styles.input}/>
          {etudiant && (
            <div style={{marginBottom:"15px"}}>
              <p><b>Nom :</b> {etudiant.nom}</p>
              <p><b>Prénom :</b> {etudiant.prenom}</p>
              <p><b>Filière :</b> {etudiant.filiere}</p>
            </div>
          )}
          <select value={type_document} onChange={(e)=>setDocument(e.target.value)} style={styles.input}>
            <option value="">
              Choisir document
            </option>
            <option value="Attestation poursuit ">
              Attestation poursuit 
            </option>
            <option value="Attestation poursuivi">
              Attestation poursuivi
            </option>
            <option value="Attestation de réussite">
              Attestation de réussite
            </option>
            <option value="Attestation inscrites ">
              Attestation inscrites 
            </option>
            <option value="Attestation a été inscrites ">
              Attestation a été inscrites 
            </option>
            <option value="Attestation des vacances">
              Attestation des vacances
            </option>
          </select>
          <button onClick={envoyerDemande} style={styles.button}>
            Envoyer la demande
          </button>
        </div>
        {/* suivi demandes */}
        <div style={styles.card}>
          <h2>Suivi des demandes</h2>
          <button onClick={() => voirDemandes(numero_apogee)} style={styles.button2}>
            Voir mes demandes
          </button>
          <table style={styles.table}>
            <thead>
              <tr>
                <th>Type document</th>
                <th>Date</th>
                <th>Etat</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              {demandes.map((d,i)=>(
              <tr key={i}>
                <td>{d.type_document}</td>
                <td>{new Date(d.created_at).toLocaleDateString()}</td>
                <td>{d.etat}</td>
                <td>
                  {d.etat?.trim() === "Signé" && (
                    <button onClick={() => imprimer(d.id)}>
                      Imprimer
                    </button>
                  )}
                </td>
              </tr>
              ))}
            </tbody>
          </table>
        </div>
        <button onClick={handleLogout} style={{position: "absolute",right: "280px",padding: "8px 15px",background: "#87CEEB",color: "black",border: "none",borderRadius: "6px",cursor: "pointer"}}>
          Déconnexion
        </button>
      </div>
    </div>
  );
}
const styles={
  page:{
    minHeight:"100vh",
    background:"linear-gradient(135deg,#1e3c72,#2a5298)",
    padding:"40px"
  },
  container:{
    maxWidth:"700px",
    margin:"auto"
  },
  title:{
    textAlign:"center",
    color:"white",
    marginBottom:"30px",
    fontSize: "32px",
  },
  card:{
    background:"white",
    padding:"25px",
    borderRadius:"10px",
    marginBottom:"25px",
    boxShadow:"0 10px 20px rgba(0,0,0,0.2)"
  },
  input:{
    width:"100%",
    padding:"10px",
    marginTop:"10px",
    marginBottom:"15px",
    borderRadius:"6px",
    border:"1px solid #ccc"
  },
  button:{
    width:"100%",
    padding:"10px",
    background:"#2a5298",
    color:"white",
    border:"none",
    borderRadius:"6px",
    cursor:"pointer"
  },
  button2:{
    padding:"8px 15px",
    background:"#1e3c72",
    color:"white",
    border:"none",
    borderRadius:"6px",
    marginBottom:"15px",
    cursor:"pointer"
  },
  table:{
    width:"100%",
    borderCollapse:"collapse"
  }
};
export default Etudiant;