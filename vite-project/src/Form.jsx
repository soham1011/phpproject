


// import React, { useState } from "react";

// const Form = () => {
//     const [expression, setExpression] = useState('');

//     const handleChange = (e) => {
//         setExpression(e.target.value);
//     };

//     return (
//         <div>
//             <div className="form">
//                 <form action="http://localhost:8000/server.php" method="POST">
//                     <h2>RPN Converter</h2>
//                     <label htmlFor="expression">Input your expression:</label>
//                     <input
//                         required
//                         id="expression"
//                         type="text"
//                         name="maroti" 
//                         value={expression}
//                         onChange={handleChange}
//                     />
//                     <button type="submit">Submit</button>
//                 </form>
//             </div>
//         </div>
//     );
// };

// export default Form;


import React, { useState } from "react";

const Form = () => {
    const [expression, setExpression] = useState('');
    const [result, setResult] = useState(null); 

    const handleChange = (e) => {
        setExpression(e.target.value);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
    
        // Debugging: Log the expression before sending it
        console.log('Expression:', expression);
    
        fetch("http://localhost:8000/server.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `maroti=${encodeURIComponent(expression)}`
        })
        .then(response => response.json())
        .then(data => {
            setResult(data.result);
        })
        .catch(error => {
            console.error("Error:", error);
        });
    };
    

    return (
        <div>
            <div className="form">
                <form onSubmit={handleSubmit}>
                    <h2>RPN Converter</h2>
                    <label htmlFor="expression">Input your expression:</label>
                    <input
                        required
                        id="expression"
                        type="text"
                        name="maroti" 
                        value={expression}
                        onChange={handleChange}
                    />
                    <button type="submit">Submit</button>
                </form>
            </div>
           
            {result !== null && (
                <div>
                    <h3>Result:</h3>
                    <p>{result}</p>
                </div>
            )}
        </div>
    );
};

export default Form;
