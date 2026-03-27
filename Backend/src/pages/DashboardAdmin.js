import React, { useEffect, useState } from "react";
import axios from "axios";
import "./dashboard.css";
export default function Dashboard(){
  const [stats,setStats] = useState([
  { number:0,title:"Demandes En cours",class:"purple"},
  { number:0,title:"Demandes Terminée",class:"blue"},
  { number:0,title:"Demandes Signée",class:"red"},
  { number:0,title:"Demandes Délivré",class:"orange"}
  ]);
  const [selectedDemande, setSelectedDemande] = useState(null);
  const [demandes,setDemandes] = useState([]);
  const fetchData = async ()=>{
    const res = await axios.get("http://127.0.0.1:8000/api/demandes");
    const data = res.data;
    setDemandes(data);
    const enCours = data.filter(d=>d.etat==="En cours").length;
    const Valide = data.filter(d=>d.etat==="Validé").length;
    const signe = data.filter(d=>d.etat==="Signé").length;
    const delivre = data.filter(d=>d.etat==="Délivré").length;
    setStats([
    {number:enCours,title:"Demandes En cours",class:"purple"},
    {number:Valide,title:"Demandes Validée",class:"blue"},
    {number:signe,title:"Demandes Signée",class:"red"},
    {number:delivre,title:"Demandes Délivré",class:"orange"}
    ]);
  };
  useEffect(()=>{
    fetchData();
  },[]);
  const statusClass = (status)=>{
  switch(status){
    case "Validé": return "blue-status";
    case "En cours": return "pink-status";
    case "Signé": return "red-status";
    case "Délivré": return "green-status";
    default: return "";
  }
  };
  return(
    <div className="dashboard">
      <h2 style={{fontSize:"30px",fontWeight:"bold",color:"#2c3e50",background:"#f5f6fa",padding:"10px 0",marginBottom:"20px",marginLeft:"100px"}}>
        Dashboard
      </h2>
      <div className="cardss">
        {stats.map((item,index)=>(
          <div key={index} className={`cardd ${item.class}`}>
            <h1>{item.number}</h1>
            <p>{item.title}</p>
          </div>
        ))}
      </div>
      <div className="tableBox">
        <table>
          <thead>
            <tr>
              <th>Document</th>
              <th>Date</th>
              <th>Statut</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            {demandes.map((d,index)=>(
              <tr key={index}>
                <td>{d.type_document}</td>
                <td>{new Date(d.created_at).toLocaleDateString()}</td>
                <td>
                <span className={`status ${statusClass(d.etat)}`}>
                  {d.etat}
                </span>
                </td>
                <td style={{cursor:"pointer",fontSize:"20px"}}onClick={()=>setSelectedDemande(d)}>
                  ⋯
                </td>

              </tr>
            ))}
            {selectedDemande && (
              <div style={{position:"fixed",top:"0",left:"0",width:"100%",height:"100%",background:"rgba(0,0,0,0.5)",display:"flex",alignItems:"center",justifyContent:"center"}}>
                <div style={{background:"white",padding:"30px",borderRadius:"10px",width:"400px"}}>
                  <h3>Informations Etudiant</h3>
                  <p><b>Apogée :</b> {selectedDemande.etudiant?.numero_apogee}</p>
                  <p><b>Nom :</b> {selectedDemande.etudiant?.nom}</p>
                  <p><b>Prénom :</b> {selectedDemande.etudiant?.prenom}</p>
                  <p><b>Document :</b> {selectedDemande.type_document}</p>
                  <p><b>Etat :</b> {selectedDemande.etat}</p>
                  <button
                  onClick={()=>setSelectedDemande(null)}
                  style={{marginTop:"15px",padding:"8px 15px",background:"#2c3e50",color:"white",border:"none",borderRadius:"5px"}}>
                    Fermer
                  </button>

                </div>
              </div>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}