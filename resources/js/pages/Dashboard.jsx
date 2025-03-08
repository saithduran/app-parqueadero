import React, { useEffect, useState } from 'react';
import axios from 'axios';

function Dashboard() {
    const [placa, setPlaca] = useState('');
    const [registros, setRegistros] = useState([]);

    useEffect(() => {
        axios.get('/api/registros').then(res => setRegistros(res.data));
    }, []);

    const handleIngreso = async () => {
        await axios.post('/api/ingreso', { placa });
        setPlaca('');
        axios.get('/api/registros').then(res => setRegistros(res.data));
    };

    const handleSalida = async (id) => {
        await axios.post(`/api/salida/${id}`);
        axios.get('/api/registros').then(res => setRegistros(res.data));
    };

    return (
        <div>
            <h2>Ingreso de Moto</h2>
            <input value={placa} onChange={e => setPlaca(e.target.value)} placeholder="Placa" maxLength={6} />
            <button onClick={handleIngreso}>Ingresar</button>

            <h2>Motos en el Parqueadero</h2>
            <table>
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Hora Ingreso</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    {registros.filter(r => r.estado === 'ingresado').map(registro => (
                        <tr key={registro.id}>
                            <td>{registro.placa}</td>
                            <td>{new Date(registro.hora_ingreso).toLocaleString()}</td>
                            <td><button onClick={() => handleSalida(registro.id)}>Registrar Salida</button></td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default Dashboard;