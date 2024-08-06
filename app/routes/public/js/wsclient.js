function setStateOfSensors(sensors) {
  const sensorsStates = {
    mq5: document.getElementById("mq5-state"),
    mq3: document.getElementById("mq3-state"),
  };

  Object.values(sensors).forEach((s) => {
    if (sensorsStates[s.name.toLowerCase()]) {
      sensorsStates[s.name.toLowerCase()].innerText = s.active ? "ACTIVE" : "DESACTIVE";
    }
  });
}

function useWebSocket({ url, onopen, onmessage, onerror }) {
  const ws = new WebSocket(url);

  ws.onopen = onopen;
  ws.onmessage = onmessage;
  ws.onerror = onerror;

  return ws;
}

function openSensorsDataStream() {
  const ws = useWebSocket({
    url: "ws://127.0.0.1:3000/sensors?id=1",
    onopen: () => {
      console.log("Connection opened with wsserver");
    },
    onmessage: (event) => {
      console.log(`Mensagem recebida do servidor: ${event.data}`);
      const sensors = JSON.parse(event.data);
      setStateOfSensors(sensors.data);
      //Object.values(sensors).forEach((s) => console.log("Sensor" + s.name));
    },
    onerror: (error) => {
      console.log(`Error: ${error}`);
    },
  });

  setInterval(() => {
    if (ws.readyState === WebSocket.OPEN) {
      ws.send("");
    }
  }, 5000);
}

openSensorsDataStream();
