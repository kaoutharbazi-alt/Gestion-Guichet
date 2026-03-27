import React from "react";
import Demandes from "./Demandes";
import DashboardAdmin from "./DashboardAdmin";
export default function AdminPage() {
  const handleLogout = () => {
  const confirmLogout = window.confirm("Voulez-vous vraiment quitter ?");
  if (confirmLogout) {
    window.location.href = "/";
  }
};
  return (
    <div>
      <Demandes />
      <DashboardAdmin />
      <button onClick={handleLogout}
        style={{position: "absolute",right: "40px",
        top: "40px",padding: "8px 15px",
        background: "red",color: "white",
        border: "none",borderRadius: "6px",
        cursor: "pointer"}}>
        Déconnexion
      </button>
    </div>
  );
}