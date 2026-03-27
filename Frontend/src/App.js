import { BrowserRouter, Routes, Route } from "react-router-dom";
import Home from "./Home";
import AdminPage from "./components/AdminPage";
import DashboardAdmin from "./pages/DashboardAdmin";
import Demandes from "./pages/Demandes";
import Admin from "./pages/Admin";
import Etudiant from "./pages/Etudiant";
function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/etudiant" element={<Etudiant />} />
        <Route path="/admin" element={<AdminPage />} />
        <Route path="/dashboard" element={<Admin />} />
        <Route path="/demandes" element={<Demandes />} />
      </Routes>
    </BrowserRouter>
  );
}
export default App;