    <!-- Modernizr js -->
	<script src="assets/js/vendor/modernizr.min.js"></script>
    <!-- Jquery Core js -->
	<script src="assets/js/vendor/jquery.min.js"></script>
    <!-- Bootstrap js -->
	<script src="assets/js/vendor/bootstrap.min.js"></script>
    <!-- Wow js -->
	<script src="assets/js/vendor/wow.min.js"></script>
    <script src="https://unpkg.com/peerjs@1.3.2/dist/peerjs.min.js"></script>

    <script src="https://unpkg.com/peerjs@1.3.2/dist/peerjs.min.js"></script>
  <script>
    const myPeerId = "70499ed1-045c-4312-9449-44532133dd9f"; // Your ID
    const peer = new Peer(myPeerId);
    let dataConn = null; // Will hold the text connection
    const chatBox = document.getElementById("chat-box");

    // Display my ID
    peer.on("open", (id) => {
      document.getElementById("my-id").textContent = id;
    });

    // Handle incoming data (text) connection
    peer.on("connection", (conn) => {
      dataConn = conn;
      setupChatEvents();
    });

    // Handle incoming calls (audio)
    peer.on("call", (call) => {
      navigator.mediaDevices.getUserMedia({ audio: true }).then((stream) => {
        call.answer(stream);
        call.on("stream", (remoteStream) => {
          document.getElementById("remote-audio").srcObject = remoteStream;
        });
      }).catch((err) => {
        alert("Mic access failed.");
      });
    });

    // Start call and open data connection
    function startCall() {
      const remoteId = document.getElementById("remote-id").value.trim();
      if (!remoteId) return alert("Please enter a valid ID.");

      // 1. Audio call
      navigator.mediaDevices.getUserMedia({ audio: true }).then((stream) => {
        const call = peer.call(remoteId, stream);
        call.on("stream", (remoteStream) => {
          document.getElementById("remote-audio").srcObject = remoteStream;
        });
      });

      // 2. Text connection
      dataConn = peer.connect(remoteId);
      setupChatEvents();
    }

    // Send chat message
    function sendMessage() {
      const msg = document.getElementById("chat-input").value;
      if (dataConn && msg.trim()) {
        dataConn.send(msg);
        appendChat("Me", msg);
        document.getElementById("chat-input").value = "";
      }
    }

    // Handle incoming messages
    function setupChatEvents() {
      if (!dataConn) return;
      dataConn.on("data", (data) => {
        appendChat("Them", data);
      });
    }

    // Append messages to chat box
    function appendChat(sender, msg) {
      const el = document.createElement("div");
      el.className = sender === "Me" ? "me" : "them";
      el.innerText = sender + ": " + msg;
      chatBox.appendChild(el);
      chatBox.scrollTop = chatBox.scrollHeight;
    }
  </script>

    <!-- Main js -->
	<script src="assets/js/main.js"></script>
