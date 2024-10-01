"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import { createPerson } from "@/requests/persons-requests";
import { validateCpf } from "@/util/cpf";

export default function Page() {
  const router = useRouter();
  const [name, setName] = useState("");
  const [cpf, setCpf] = useState("");

  const handleSubmit = async (event: React.FormEvent) => {
    event.preventDefault();
    if (!validateCpf(cpf)){
        alert('CPF inválido');
        return;
    }
    await createPerson({ name, cpf });
    router.push("/");
  };

  return (
    <div className="flex flex-col mx-auto w-4/6 mt-4 gap-4 items-center">
      <h1 className="text-2xl">Criar nova pessoa</h1>
      <form onSubmit={handleSubmit} className="w-full">
        <div className="mb-3">
          <label htmlFor="name" className="form-label">
            Nome:
          </label>
          <input
            type="text"
            id="name"
            value={name}
            onChange={(e) => setName(e.target.value)}
            className="form-control"
            required
          />
        </div>
        <div className="mb-3">
          <label htmlFor="cpf" className="form-label">
            CPF:
          </label>
          <input
            type="text"
            id="cpf"
            value={cpf}
            onChange={(e) => setCpf(e.target.value)}
            className="form-control"
            required
          />
        </div>
        <button type="submit" className="btn btn-success">
          Criar pessoa
        </button>
      </form>
    </div>
  );
}
